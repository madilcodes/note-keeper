document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('coffeeForm');
    var orderSummary = document.getElementById('orderSummary');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        var coffeeType = form.coffeeType.value;
        var coffeePrice = getCoffeePrice(coffeeType);

        

        // Submit the form data to process_order.php
        var formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                orderSummary.innerHTML += `<p>${data}</p>`;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
    

    function getCoffeePrice($coffeeType)
    {
    
        switch ($coffeeType) {
            case 'espresso':
                return 116;
            case 'latte':
                return 126;
            case 'cappuccino':
                return 350;
            case 'milk':
                return 142;
            case 'Classic Filter Coffee':
                return 163;
            case 'Macchiato':
                return 147;
            case 'Cafe Americano':
                return 186;
            case 'Toffee Cappuccino':
                return 144;
            case 'Vanilla Cappuccino':
                return 150;
            case 'Toffee Latte':
                return 178;
            case 'Devils Own Vanilla Cream':
                return 183;
            case 'Ethiopian Coffee':
                return 172;
            case 'Kadak Chai':
                return 79;
            case 'Green Tea':
                return 125;
            case 'Darjeeling Tea':
                return 144;
            case 'Masala Chai':
                return 155;
            case 'Tropical Iceberg':
                return 161;
            case 'Cold Toffee Coffee':
                return 172;
            case 'Cold Cafe Mocha':
                return 149;
            case 'Cold Coconut Milk Latte':
                return 161;
            case 'Cold Cocoa Latte':
                return 155;
            case 'Hot Gourmet Cocoa Cream':
                return 147;
            default:
                return 0.00;
        }
    }
});
