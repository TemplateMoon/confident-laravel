<?php

namespace Tests\Feature\LessonTwo\Http\Controllers;

use App\Models\Coupon;
use Database\Factories\CouponFactory;
// use Database\Factories\CouponFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CouponControllerTest extends TestCase
{  use HasFactory;
    use RefreshDatabase;
    /**
     *
     *
     * @test
     */
    public function it_stores_coupon_and_redirects()
    {

        // $this->withoutExceptionHandling();
        $coupon = Coupon::factory()->create();
        $response = $this->get('/promotions/'. $coupon->code);

        $response->assertRedirect('/#buy-now');
        $response->assertSessionHas('coupon_id', $coupon->id);
    }


    //not a valid code
    /**
     * @test
     */

    public function it_does_not_store_coupon_for_invalid_code(){

        $response = $this->get('/promotions/invalid-code');

        $response->assertRedirect('/#buy-now');
        $response->assertSessionMissing('coupon_id');

    }

    //expired coupon
    /**
     * @test
     */

    public function it_does_not_store_an_expired_coupon_(){

        $coupon = Coupon::factory()->create([
            'expired_at' => now(),
        ]);

        $response = $this->get('/promotions/' . $coupon->id);

        $response->assertRedirect('/#buy-now');
        $response->assertSessionMissing('coupon_id');

    }

    /**
     * @test
     */
    public function it_does_not_store_a_previously_used_coupon(){

        $this->markTestIncomplete();

        $response = $this->get('/promotions/previously-used-code');

        $response->assertRedirect('/#buy-now');
        $response->assertSessionMissing('coupon_id');

    }
}
