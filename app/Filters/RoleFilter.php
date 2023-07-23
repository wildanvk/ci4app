<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $allowedRoles = null)
    {
        // Pastikan pengguna telah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login'); // Ganti "/login" dengan halaman login Anda
        }

        // Ambil role pengguna dari session
        $userRole = session()->get('role');

        // Periksa apakah role pengguna adalah "superadmin"
        if (in_array('Superadmin', $allowedRoles) && $userRole === 'Superadmin') {
            return; // Lanjutkan akses jika pengguna adalah "superadmin"
        }

        // Periksa apakah role pengguna termasuk dalam role yang diizinkan
        if (!in_array($userRole, $allowedRoles)) {
            // Jika tidak diizinkan, kembalikan ke halaman lain atau tampilkan pesan akses ditolak
            return redirect()->to('/access-denied'); // Ganti "/access-denied" dengan halaman akses ditolak atau tindakan lain
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
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
