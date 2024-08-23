<?php 
namespace App\Enum;

enum OrderStatus: string
{
    case Ordered = 'ordered';
    case Paid = 'paid';
    case Delivering = 'delivering';
    case Received = 'received';
    case Cancelled = 'cancelled';
}


?>