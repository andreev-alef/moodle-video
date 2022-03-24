<!DOCTYPE html>
<?php
$url1 = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$s = scandir(getcwd());
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="font-family: monospace; font-size: 12pt">
        <?php foreach ($s as $v): ?>
            <?php if (!is_dir($v)): $f = $v ?>
                <p>
                    <?php
                    if (strstr(mime_content_type($f), 'video/')):
                        $video_code = '<video id="my-video-player" width="480" oncontextmenu="return false;" controls="" controlslist="nodownload">'
                                . '<source src="' . $url1 . rawurlencode($f) . '"></video>';
                        $video_id = bin2hex(openssl_random_pseudo_bytes(10));
                        //$video_id = uniqid('', true);
                        ?>
                        <button onclick="navigator.clipboard.writeText(document.getElementById('<?= $video_id ?>').value)">
                            Скопировать код видеоплеера в буфер</button> <a href="<?= $url1 . $f ?>"><?= $f ?></a> Тип файла: <?= mime_content_type($f) ?>
                        <textarea id="<?= $video_id ?>" style="width: 0px; height: 0px; visibility: hidden"><?= $video_code ?></textarea>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
        <?php endforeach; ?>
        <div>
            <p><?= uniqid('id_', true)?>
            <p><?= bin2hex(openssl_random_pseudo_bytes(10))  ?>
            <p><?= $url1  ?>
            <p><?= str_replace(pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME),'', $url1) ?>
        </div>
    </body>
</html>
