<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_login_as_admin(): void
    {
       $response = $this->post('/login', [
            'email' => 'admin@gmail.com',
            'password' => '88888888',
        ]);

        $response->assertRedirect('/admin/dashboard'); // Ganti dengan path yang sesuai setelah login
        $this->assertAuthenticated(); // Pastikan pengguna berhasil diautentikasi

        $responseDashboard = $this->get('/admin/dashboard');
        $responseDashboard->assertSee('List All Pengajuan');
    }

    public function test_user_can_login_as_user(): void
    {
       $response = $this->post('/login', [
            'email' => 'user@gmail.com',
            'password' => '88888888',
        ]);

        $response->assertRedirect('/calendar/index'); // Ganti dengan path yang sesuai setelah login
        $this->assertAuthenticated(); // Pastikan pengguna berhasil diautentikasi

        $responseDashboard = $this->get('/calendar/index');
        $responseDashboard->assertSee('Aplikasi Kunjungan Industri SIMS Lifemedia');
    }
}
