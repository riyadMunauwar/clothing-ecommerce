<?php 

namespace App\Services;


class SweetAlertToast 
{


    public function success($title)
    {

        return $this->dispatchAlertToSession([
            'background' => '#a5dc86',
            'color' => '#fff',
            'iconColor' => '#fff',
            'icon' => 'success',
            'title' => $title,
        ]);

    }


    public function error($title)
    {

        return $this->dispatchAlertToSession([
            'background' => '#f27474',
            'color' => '#fff',
            'iconColor' => '#fff',
            'icon' => 'error',
            'title' => $title,
        ]);

    }


    public function warning($title)
    {

        return $this->dispatchAlertToSession([
            'background' => '#fbbf24',
            'color' => '#fff',
            'iconColor' => '#fff',
            'icon' => 'warning',
            'title' => $title,
        ]);
        
    }


    public function info($title)
    {   

        return $this->dispatchAlertToSession([
            'background' => '#3fc3ee',
            'color' => '#fff',
            'iconColor' => '#fff',
            'icon' => 'info',
            'title' => $title,
        ]);

    }


    public function question($title)
    {

        return $this->dispatchAlertToSession([
            'background' => '#87adbd',
            'color' => '#fff',
            'iconColor' => '#fff',
            'icon' => 'question',
            'title' => $title,
        ]);

    }
    

    public function toast($options)
    {
        return $this->dispatchAlertToSession($options);
    }

    public function basic($title)
    {
        return $this->dispatchAlertToSession([
            'background' => '',
            'color' => '',
            'iconColor' => '',
            'icon' => 'success',
            'title' => $title
        ]);
    }


    private function preparedOptions($options)
    {
        
        $defaultOptions = [
            'background' => '#fff',
            'color' => '#6b7280',
            'iconColor' => '#6b7280',
            'icon' => 'success',
            'title' => '',
        ];

        return array_merge($defaultOptions, $options);

    }



    private function dispatchAlertToSession($options)
    {
        return session()->flash('swalToastOptions', $this->preparedOptions($options));
    }

}