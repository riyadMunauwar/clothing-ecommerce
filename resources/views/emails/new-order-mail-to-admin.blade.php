@component('mail::message')
# New Order Created

A new order has been created in the system.

**User Information:**
- Name: {{ $order->user->name }}
- Email: {{ $order->user->email }}

**Order Information:**
- Order ID: {{ $order->id }}
- Order Unique NO: {{ $order->order_no }}
- Order Total: ${{ $order->total_price ?? '' }}
- Order Shipping Charge: ${{ $order->shipping_price ?? '' }}
- Order Date: {{ $order->created_at->format('Y-m-d H:i:s') }}

Thank you for your attention.

@endcomponent