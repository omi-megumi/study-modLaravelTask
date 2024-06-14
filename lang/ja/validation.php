<?php

declare(strict_types=1);

return [
    'accepted'             => ':attributeを承認してください。',
    'accepted_if'          => ':otherが:valueの場合、:attributeを承認する必要があります。',
    'active_url'           => ':attributeは、有効なURLではありません。',
    'after'                => ':attributeには、:dateより後の日付を指定してください。',
    'after_or_equal'       => ':attributeには、:date以降の日付を指定してください。',
    'alpha'                => ':attributeには、アルファベッドのみ使用できます。',
    'alpha_dash'           => ':attributeには、英数字(\'A-Z\',\'a-z\',\'0-9\')とハイフンと下線(\'-\',\'_\')が使用できます。',
    'alpha_num'            => ':attributeには、英数字(\'A-Z\',\'a-z\',\'0-9\')が使用できます。',
    'array'                => ':attributeには、配列を指定してください。',
    'ascii'                => ':attributeには、英数字と記号のみ使用可能です。',
    'before'               => ':attributeには、:dateより前の日付を指定してください。',
    'before_or_equal'      => ':attributeには、:date以前の日付を指定してください。',
    'between'              => [
        'array'   => ':attributeの項目は、:min個から:max個にしてください。',
        'file'    => ':attributeには、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'numeric' => ':attributeには、:minから、:maxまでの数字を指定してください。',
        'string'  => ':attributeは、:min文字から:max文字にしてください。',
    ],
    'boolean'              => ':attributeには、\'true\'か\'false\'を指定してください。',
    'confirmed'            => ':attributeと:attribute確認が一致しません。',
    'current_password'     => 'パスワードが正しくありません。',
    'date'                 => ':attributeは、正しい日付ではありません。',
    'date_equals'          => ':attributeは:dateに等しい日付でなければいけません。',
    'date_format'          => ':attributeの形式が\':format\'と一致しません。',
    'decimal'              => ':attributeは、小数点以下が:decimalでなければなりません。',
    'declined'             => ':attributeを拒否する必要があります。',
    'declined_if'          => ':otherが:valueの場合、:attributeを拒否する必要があります。',
    'different'            => ':attributeと:otherには、異なるものを指定してください。',
    'digits'               => ':attributeは、:digits桁にしてください。',
    'digits_between'       => ':attributeは、:min桁から:max桁にしてください。',
    'dimensions'           => ':attributeの画像サイズが無効です',
    'distinct'             => ':attributeの値が重複しています。',
    'doesnt_end_with'      => ':attributeは次のいずれかで終わってはいけません。: :values',
    'doesnt_start_with'    => ':attributeは次のうちいずれかで始まってはいけません。: :values',
    'email'                => ':attributeは、有効なメールアドレス形式で指定してください。',
    'ends_with'            => ':attributeは、次のうちのいずれかで終わらなければいけません。: :values',
    'enum'                 => '選択した :attributeは 無効です。',
    'exists'               => '選択された:attributeは、有効ではありません。',
    'file'                 => ':attributeはファイル形式でなければいけません。',
    'filled'               => ':attributeは必須です。',
    'gt'                   => [
        'array'   => ':attributeの項目数は、:value個より多くなければいけません。',
        'file'    => ':attributeは、:value KBより大きくなければいけません。',
        'numeric' => ':attributeは、:valueより大きくなければいけません。',
        'string'  => ':attributeは、:value文字より大きくなければいけません',
    ],
    'gte'                  => [
        'array'   => ':attributeの項目数は、:value個以上でなければいけません。',
        'file'    => ':attributeは、:value KB以上でなければいけません。',
        'numeric' => ':attributeは、:value以上でなければいけません。',
        'string'  => ':attributeは、:value文字以上でなければいけません。',
    ],
    'image'                => ':attributeには、画像を指定してください。',
    'in'                   => '選択された:attributeは、有効ではありません。',
    'in_array'             => ':attributeが:otherに存在しません。',
    'integer'              => ':attributeには、整数を指定してください。',
    'ip'                   => ':attributeには、有効なIPアドレスを指定してください。',
    'ipv4'                 => ':attributeはIPv4アドレスを指定してください。',
    'ipv6'                 => ':attributeはIPv6アドレスを指定してください。',
    'json'                 => ':attributeには、有効なJSON文字列を指定してください。',
    'lowercase'            => ':attributeは、小文字で入力してください。',
    'lt'                   => [
        'array'   => ':attributeの項目数は、:value個より少なくなければいけません。',
        'file'    => ':attributeは、:value KBより小さくなければいけません。',
        'numeric' => ':attributeは、:valueより小さくなければいけません。',
        'string'  => ':attributeは、:value文字より小さくなければいけません。',
    ],
    'lte'                  => [
        'array'   => ':attributeの項目数は、:value個以下でなければいけません。',
        'file'    => ':attributeは、:value KB以下でなければいけません。',
        'numeric' => ':attributeは、:value以下でなければいけません。',
        'string'  => ':attributeは、:value文字以下でなければいけません。',
    ],
    'mac_address'          => ':attributeは有効なMACアドレスである必要があります。',
    'max'                  => [
        'array'   => ':attributeの項目数は、:max個以下でなければいけません。',
        'file'    => ':attributeは、:max KB以下のファイルでなければいけません。',
        'numeric' => ':attributeは、:max以下の数字でなければいけません。',
        'string'  => ':attributeの文字数は、:max文字以下でなければいけません。',
    ],
    'max_digits'           => ':attributeは、:max桁以下の数字でなければいけません。',
    'mimes'                => ':attributeには、以下のファイルタイプを指定してください。:values',
    'mimetypes'            => ':attributeには、以下のファイルタイプを指定してください。:values',
    'min'                  => [
        'array'   => ':attributeの項目数は、:min個以上にしてください。',
        'file'    => ':attributeには、:min KB以上のファイルを指定してください。',
        'numeric' => ':attributeには、:min以上の数字を指定してください。',
        'string'  => ':attributeの文字数は、:min文字以上でなければいけません。',
    ],
    'min_digits'           => ':attributeは、:min桁以上の数字でなければいけません。',
    'missing'              => ':attribute フィールドが欠落している必要があります。',
    'missing_if'           => ':other が :value の場合、:attribute フィールドが欠落している必要があります。',
    'missing_unless'       => ':other が :value でない限り、:attribute フィールドは欠落している必要があります。',
    'missing_with'         => ':values が存在する場合、:attribute フィールドは欠落している必要があります。',
    'missing_with_all'     => ':values が存在する場合、:attribute フィールドは欠落している必要があります。',
    'multiple_of'          => ':attributeは:valueの倍数でなければいけません',
    'not_in'               => '選択された:attributeは、有効ではありません。',
    'not_regex'            => ':attributeの形式が正しくありません。',
    'numeric'              => ':attributeには、数字を指定してください。',
    'password'             => [
        'letters'       => ':attributeは文字を1文字以上含める必要があります。',
        'mixed'         => ':attributeは大文字と小文字をそれぞれ1文字以上含める必要があります。',
        'numbers'       => ':attributeは数字を1文字以上含める必要があります。',
        'symbols'       => ':attributeは記号を1文字以上含める必要があります。',
        'uncompromised' => ':attributeは情報漏洩した可能性があります。他の:attributeを選択してください。',
    ],
    'present'              => ':attributeが存在している必要があります。',
    'prohibited'           => ':attributeの入力は禁止されています。',
    'prohibited_if'        => ':otherが:valueの場合は、:attributeの入力が禁止されています。',
    'prohibited_unless'    => ':otherが:valuesでない限り、:attributeの入力は禁止されています。',
    'prohibits'            => ':otherが存在している場合、:attributeの入力は禁止されています。',
    'regex'                => ':attributeには、正しい形式を指定してください。',
    'required'             => ':attributeは必須項目です。',
    'required_array_keys'  => ':attributeには、:valuesのエントリを含める必要があります。',
    'required_if'          => ':otherが:valueの場合、:attributeを指定してください。',
    'required_if_accepted' => ':otherを承認した場合、:attributeは必須項目です。',
    'required_unless'      => ':otherが:values以外の場合、:attributeは必須項目です。',
    'required_with'        => ':valuesが入力されている場合、:attributeは必須項目です。',
    'required_with_all'    => ':valuesが全て指定されている場合、:attributeは必須項目です。',
    'required_without'     => ':valuesが入力されていない場合、:attributeは必須項目です。',
    'required_without_all' => ':valuesが全て指定されていない場合、:attributeを指定してください。',
    'same'                 => ':attributeと:otherが一致しません。',
    'size'                 => [
        'array'   => ':attributeの項目数は、:size個にしてください。',
        'file'    => ':attributeには、:size KBのファイルを指定してください。',
        'numeric' => ':attributeには、:sizeを指定してください。',
        'string'  => ':attributeの文字数は、:size文字にしてください。',
    ],
    'starts_with'          => ':attributeは、次のいずれかで始まる必要があります。:values',
    'string'               => ':attributeには、文字列を指定してください。',
    'timezone'             => ':attributeには、有効なタイムゾーンを指定してください。',
    'ulid'                 => ':attributeは、有効なULIDでなければいけません。',
    'unique'               => '指定の:attributeは既に使用されています。',
    'uploaded'             => ':attributeのアップロードに失敗しました。',
    'uppercase'            => ':attributeは、大文字で入力してください。',
    'url'                  => ':attributeは、有効なURL形式で指定してください。',
    'uuid'                 => ':attributeは、有効なUUIDでなければいけません。',
];