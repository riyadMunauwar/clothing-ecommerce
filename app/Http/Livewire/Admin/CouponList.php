<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Coupon;

class CouponList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onCouponCreated' => '$refresh',
        'onCouponUpdated' => '$refresh',
        'onCouponDelete' => 'deleteCoupon',
    ];


    public function render()
    {
        $coupons = $this->getCoupons();

        return view('admin.components.coupon-list', compact('coupons'));
    }


    public function enableCouponEditMode($id)
    {
        $this->emit('onCouponEdit', $id);
    }


    public function confirmDeleteCoupon($id)
    {
        return $this->ifConfirmThenDispatch('onCouponDelete', $id, 'Are you sure ?', 'Coupon will delete permanently !');
    }


    public function deleteCoupon($id)
    {
        try {
            Coupon::destroy($id);
            return $this->success('Success', 'Coupon deleted successfully.');
        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Failed to delete Coupon. try again');
        }

    }

    public function openSlideList($CouponId)
    {
        $this->emit('onOpenSlideList', $CouponId);
    }


    private function getCoupons()
    {

        $search = $this->search;

        $query = Coupon::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search)
                  ->orWhere('code', 'like', '%' . $search . '%')
                  ->orWhere('code', $search);
        });

        return $query->paginate(25);

    }
}
