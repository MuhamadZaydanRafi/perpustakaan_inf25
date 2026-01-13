<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterAdmin implements FilterInterface
{
    /**
     * Filter khusus untuk Admin saja
     * Mencegah petugas mengakses halaman user dan pengaturan
     */
   public function before(RequestInterface $request, $roles = null)
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Cegah anggota (member) mengakses admin dashboard
        if (session()->get('nim')) {
            return redirect()->to('/anggota/dashboard');
        }

        // Cegah petugas mengakses halaman admin tertentu
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/forbidden');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
