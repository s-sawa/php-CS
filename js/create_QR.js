function createQR(id) {
    const url = 'https://localhost/task/php-CS/register_card.php?id=' + id;
    // const url = 'https://swshgeek.sakura.ne.jp/php-CS/register_card.php?id=' + id;
    console.log(id);
    console.log(url)
    let qrtext = url;
    let utf8qrtext = unescape(encodeURIComponent(qrtext));
    $("#img-qr").html("");
    $("#img-qr").qrcode({text:utf8qrtext}); 
    
};
