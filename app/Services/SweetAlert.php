<?php 

namespace App\Services;

class SweetAlert 
{


    public function success($title, $message)
    {

        return $this->dispatchAlertToSession([
            'icon' => 'success',
            'title' => $title,
            'text' => $message,
        ]);

    }


    public function error($title, $message)
    {

        return $this->dispatchAlertToSession([
            'icon' => 'error',
            'title' => $title,
            'text' => $message,
        ]);

    }


    public function warning($title, $message)
    {

        return $this->dispatchAlertToSession([
            'icon' => 'warning',
            'title' => $title,
            'text' => $message,
        ]);
        
    }


    public function info($title, $message)
    {   

        return $this->dispatchAlertToSession([
            'icon' => 'info',
            'title' => $title,
            'text' => $message,
        ]);

    }


    public function question($title, $message)
    {

        return $this->dispatchAlertToSession([
            'icon' => 'question',
            'title' => $title,
            'text' => $message,
        ]);

    }


    public function alert($options)
    {
        return $this->dispatchAlertToSession($options);
    }



    private function preparedOptions($options)
    {
        
        $defaultOptions = [
            'background' => '',
            'color' => '',
            'iconColor' => '',
            'icon' => 'success',
            'title' => '',
            'text' => ''
        ];

        return array_merge($defaultOptions, $options);

    }


    private function dispatchAlertToSession($options)
    {
        return session()->flash('swalAlertOptions', $this->preparedOptions($options));
    }

}