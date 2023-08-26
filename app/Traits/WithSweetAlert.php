<?php 


namespace App\Traits;


trait WithSweetAlert 
{
    
    public function success($title, $message)
    {
        $this->fireBrowserEvent([
            'icon' => 'success',
            'title' => $title,
            'text' => $message,
        ]);
    }

    public function error($title, $message)
    {
        $this->fireBrowserEvent([
            'icon' => 'error',
            'title' => $title,
            'text' => $message,
        ]);
    }


    public function warning($title, $message)
    {
        $this->fireBrowserEvent([
            'icon' => 'warning',
            'title' => $title,
            'text' => $message,
        ]);
    }

    public function info($title, $message)
    {
        $this->fireBrowserEvent([
            'icon' => 'info',
            'title' => $title,
            'text' => $message,
        ]);
    }

    public function question($title, $message)
    {
        $this->fireBrowserEvent([
            'icon' => 'question',
            'title' => $title,
            'text' => $message,
        ]);
    }


    public function alert($options = [])
    {
        $this->fireBrowserEvent($options);
    }



    public function ifConfirmThenDispatch($event, $payload, $title = '', $message = '')
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'icon' => 'warning',
            'title' => $title ? $title : 'Are you sure ?',
            'text' => $message,
            'event' => $event,
            'event' => $event,
            'payload' => $payload
        ]);
    }


    private function preparedOptions($options)
    {
        $defaultOptions = [
            'color' => '',
            'iconColor' => '',
            'background' => '',
            'icon' => 'success',
            'title' => '',
            'text' => '',
            'event' => '',
            'payload' => false,
        ];

        return array_merge($defaultOptions, $options);
    }

    

    private function fireBrowserEvent($options)
    {
        $this->dispatchBrowserEvent('swal:alert', $this->preparedOptions($options));
    }
}