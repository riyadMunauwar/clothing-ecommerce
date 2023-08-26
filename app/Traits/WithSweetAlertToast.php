<?php


namespace App\Traits;


trait WithSweetAlertToast 
{

    public function successToast($title)
    {
        $this->fireToastBrowserEvent([
            'color' => '#fff',
            'iconColor' => '#fff',
            'background' => '#a5dc86',
            'icon' => 'success',
            'title' => $title,
        ]);
    }

    public function errorToast($title)
    {
        $this->fireToastBrowserEvent([
            'color' => '#fff',
            'iconColor' => '#fff',
            'background' => '#f27474',
            'icon' => 'error',
            'title' => $title,
        ]);
    }


    public function warningToast($title)
    {
        $this->fireToastBrowserEvent([
            'color' => '#fbbf24',
            'iconColor' => '#fff',
            'background' => '#f27474',
            'icon' => 'warning',
            'title' => $title,
        ]);
    }

    public function infoToast($title)
    {
        $this->fireToastBrowserEvent([
            'color' => '#fff',
            'iconColor' => '#fff',
            'background' => '#3fc3ee',
            'icon' => 'info',
            'title' => $title,
        ]);
    }

    public function questionToast($title)
    {
        $this->fireToastBrowserEvent([
            'color' => '#fff',
            'iconColor' => '#fff',
            'background' => '#87adbd',
            'icon' => 'question',
            'title' => $title,
        ]);
    }


    public function toast($title)
    {
        $this->fireToastBrowserEvent([
            'title' => $title,
        ]);
    }


    public function customToast($options = [])
    {
        $this->fireToastBrowserEvent($options);
    }


    private function preparedToastOptions($options)
    {
        $defaultOptions = [
            'color' => '',
            'iconColor' => '',
            'background' => '',
            'icon' => 'success',
            'title' => '',
        ];

        return array_merge($defaultOptions, $options);
    }

    

    private function fireToastBrowserEvent($options)
    {
        $this->dispatchBrowserEvent('swal:toast', $this->preparedToastOptions($options));
    }

}