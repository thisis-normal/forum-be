<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Throwable;
class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Exception|Throwable $e): Response|JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        // Kiểm tra nếu đây là một instance của ModelNotFoundException
        if ($e instanceof ModelNotFoundException) {
            // Tùy chỉnh thông điệp lỗi và mã phản hồi
            return response()->json([
                'error' => 'Không tìm thấy tài nguyên yêu cầu'
            ], 404);
        }
        // Nếu không, để xử lý ngoại lệ như bình thường
        return parent::render($request, $e);
    }
}
