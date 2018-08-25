<?php namespace Dpsoft\Asiasms\Exception;


class AsiasmsException extends \Exception
{
    /**
     * AsiasmsException constructor.
     * @param int $code
     */
    public function __construct(int $code)
    {
        $this->message = $this->codeToMessage((int)$code);
        $this->code = $code;
    }

    /**
     * @param int $code
     * @return mixed|string
     */
    private function codeToMessage(int $code)
    {
        $errors = [
            0 => 'بدون خطا',
            1 => 'حساب غیر فعال می باشد.',
            2 => 'حساب منقضی شده است.',
            3 => 'حساب یا درخواست نامعتبر است.',
            4 => 'خطای سرور',
            5 => 'لیست گیرندگان خالی می باشد.',
            6 => 'فرستنده نامعتبر است.',
            7 => 'اطلاعات ورودی صحیح نمی باشد.',
            8 => 'آی پی نامعتبر می باشد.',
            9 => 'شماره گیرندگان نامعتبر می باشد.',
            10 => 'شماره فرستنده نامعتبر است.',
            11 => 'شماره گیرنده نامعتبر است.',
            12 => 'پیامک دریافتی یافت نشد.',
            14 => 'تعداد پیامک در هر ارسال بیشتر از حد مجاز است.'
        ];

        return !empty($errors[$code]) ? $errors[$code] : 'خطای تعریف نشده!';
    }
}