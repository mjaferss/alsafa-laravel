<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SidebarController extends Controller
{
    /**
     * Toggle sidebar state
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Request $request)
    {
        $isCollapsed = $request->input('isCollapsed', false);
        session(['sidebar_collapsed' => $isCollapsed]);
        
        return response()->json([
            'success' => true,
            'isCollapsed' => $isCollapsed
        ]);
    }

    /**
     * Get sidebar state
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getState()
    {
        return response()->json([
            'isCollapsed' => session('sidebar_collapsed', false)
        ]);
    }
}
