<?php

return [
    'alipay' => [
        'app_id'         => '2016100100642302',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAp067ojvOxrv4vkt3AQcpQE6573q3o/3CK3ALGlXVppm9KhU0+Go0QSnsVAoFOvXtGQhL/oWmoFyXHk+oEIAFz0/73pASuyqkJowlcP8A4sEj0zj73/vma1eBDxWSAa2h503JBoNDLh4RILm8PpKIh6EiSc9GKlm+duyx7olThWyqf1TkbVwq7AkwkETBOh8zBTkebLNaSaeSlq+qWaOh4Yors3pvgqgS5Ij4aMNcPXhXYiZcPqf1lSLhyOW7EQzOuArVDUUUJfXmp4Hwf0mzJMTfNf6AL8azkTvJnxoWeokEJfMsC71FYS5dN4GAwswBmwHqXbXLCPluZUIqA7WTZQIDAQAB',
        'private_key'    => 'MIIEpQIBAAKCAQEAtog2W7fcUEFoOdpSQcL6QD0+46xUecT4X6v2s0TZ2OQUI6K6+5H0U3zTIemcOiAf0jyIEi0PrSWQ9HeHeRTsayctidrxRKnExB+1FvN5AdUbgU8ZMk9jlRgvc/r/7rZ9cY+p2qBREpZW+rID92FS8Dx6mm8NOB2dSluB3Y6PvQYzJjotHnhmn/vSZFwsmzOM7fLxitXlwRyjABPIXZDEQ4WSWMqJmk6phh3c3mRatTx93jwMgmcH2XaNE/CfBqU0dRWfSmCeuZJHiESzaK8jH4EJdqcvS3w19elCVIwGlUEAJh1AHONpXcHh536mIAQAROUuCqpT40A0QG+/vdcCfwIDAQABAoIBAQCu0TA2kZYIq0wWNHmZkBK7Wa0UwqS5ZyN2Ba2mLifyaSa8possi7IUD7XqgeHlbYTshprPxaaA7zywVpZCKf7v9TrREAcI+wt/xtpaW98mGSNZqhb4rz4xulMgYmGiD9d+3tgPkoFzKtetDLdtwyF7AoFtzTQ87WgKoi9zsakKn/fqFwqIqOPHwWy8RpIJRae2Clt/RuYRRDWqpkCPcVuQ/oXWUfK2H95iYYXsX/lL9Y3oTwBr+d+1p2rEQS1olkPbf5HtpibIJFnS7IDZBXkD40xrvvwi/5krU4oI8uX4CNQueWRXnsjSIe5mFYJW6X9J553riAw2WY12UcX19DvJAoGBAPEsJb0urGL+SVU5kDnZmbMTC5aoV6zUPeHUtvyjBIgqdRYU6xfIAmMs0lrimLtrUBxObgBNqP2i5dx4BvGd9y89h5QWFct25L43IdXR62CPL2/hI4R0fuJAvChjQSA879Dl89xUXWche6A1sefZbpZBfD0mUC2fEOInWJLRMzS7AoGBAMHBHVJpwcJEBx4NSn8/XoUfuKUcu8dmySq8WiTVqI5tNpWGPo+bZd+7FlzXJENlBq8zuzv7iPd3QlF9ZJ6JCVRpZLB4q1bCvqAyVmhQw0U7UNxG2FfYTMPFX5ar7KcCUSzv1O95d8jxq43WYHeyxL/PATLzvJZDLra4mT6FPS8NAoGBAIlAN6YHluGrl65h2RujI96OuyydV3ArRaBs/0qdt6mKiCHt+7EICZvJWVmR1ZvrwaaqV93iVIcsGqayxDjjTlZbLPpw6yxk2F8MXzwhgFPuiO+h8CWkasV2U96kRd8D7vMyuuqsNI/JtWKCzGGHE3F9iSf/0udzvBcIj1bWqc6bAoGAI3iVQ6c037nQi8HnJ5CUX07FYQT3o7O/lGFTJ3cuGpUH7yvafDP43JLFr017yBLQvHZ+CqcsFhHxRDXum89+s8NvuZb91y5j87QDeal/dkc7sHgP11U0CIszysPC2XhlIBLwKr9UHKeRvq/GjWNe/baKA6f3mJLIFI+LDpUZ9GkCgYEAtcdlntY1PcSrCnjgszCCOnrpDd1f3mVMItodFSg2ai/9OeVuq2qtEW+rzPrwJQcRwK86BXpyivDbN/Bzj1awDHaIfpL+p5ea7Qp/YmlMOe01LaG+V4Q6iHxoUmCilddRYWvbW8PXg/5GX3AtLDmsOb8ZmXnd0qIcJLwD4fW22/o=',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];