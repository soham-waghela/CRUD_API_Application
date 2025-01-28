<?php

use App\Http\Resources\ProductResource;
use App\Models\Product;

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});


it('test_product_creation', function () 
        {
            $product = new Product([
                'name'=>'test product',
                'description'=>'yaha desc hai',
                'price'=> 8888
            ]);
            $this->assertequals('test product',$product->name);
            $this->assertequals('yaha desc hai',$product->description);
            $this->assertequals('8888',$product->price);

        }   
);

it('test_product_creation2', function () 
        {
            $product = new Product([
                'name'=>'test nahi hai product',
                'description'=>'yaha toh bapre desc hai',
                'price'=> 883332
            ]);
            $this->assertequals('test nahi hai product',$product->name);
            $this->assertequals('yaha toh bapre desc hai',$product->description);
            $this->assertequals('883332',$product->price);

        }  
   );

it('checks if product description is null when not set', function () 
    {
    $product = new Product(['name' => 'Test Product']);
    $this->assertNull($product->description);
    }
 );

it('check if value is not null or not',function()
    {
        $product = new Product([
            'name'=>'Test 1',
            'description'=>'temp description'
        ]);

    $this->assertNotNull($product->name);
    $this->assertNotNull($product->description);
    $this->assertNull($product->price);
    }
 );

it('checks if the product name contains the word "Product"', function () 
    {
        $product = new Product(['name' => 'Test Product']);
        $this->assertTrue(str_contains($product->name, 'Product'));
    }
  );

test('fetching enrty from DB', function()
        {
        $product=Product::find(4);
        expect($product->name)->toEqual("mango");
        }
    );

it('checks if the product is an instance of Product class', function () {
        $product = new Product([
            'name' => 'Test Product',
            'description' => 'This is a test description.',
            'prie' => 99.99
        ]);
        $this->assertInstanceOf(Product::class, $product);
    });
    