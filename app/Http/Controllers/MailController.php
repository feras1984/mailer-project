<?php

namespace App\Http\Controllers;

//use App\Services\PHPMailerService;
use App\Services\MailerContract;
use App\Services\PHPMailerService\PHPMailerService;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function send(MailerContract $contract) {
        $data = \request()->all();
//        dd($data['files'][0]);
        try {
//            $phpMailer = new PHPMailerService();
            
            $contract->send($data['recipient'], $data['cc'], $data['bcc'], $data['subject'], $data['content'], $data['files']);
            return \response()->json(['message' => 'Message has been successfully sent!']);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
