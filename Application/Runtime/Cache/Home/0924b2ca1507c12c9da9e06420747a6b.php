<?php if (!defined('THINK_PATH')) exit();?><!--<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js" type="text/javascript"></script>-->

<!--<script src="/Public/Home/js/CryptoJS/components/core.js"></script>-->
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/hmac-sha256.js"></script>
<!--<script src="/Public/Home/js/CryptoJS/components/evpkdf.js"></script>-->
<!--<script src="/Public/Home/js/CryptoJS/components/enc-base64.js"></script>-->
<script src="/Public/Home/js/CryptoJS/components/cipher-core.js"></script>
<!--<script src="/Public/Home/js/CryptoJS/components/aes.js"></script>-->
<script src="/Public/Home/js/CryptoJS/components/hmac.js"></script>
<!--<script src="/Public/Home/js/CryptoJS/components/sha1.js"></script>-->
<script src="/Public/Home/js/CryptoJS/components/sha256.js"></script>

<script>
	var xhr = new XMLHttpRequest(),
			secret = 'HeKi5_wYlVA14KvomUPIHC-9Bn7l780R',
			body = 'apikey=' + 'ZltcUKL-efitFwcNaukqtWgBhYq5UZlo' + '&nonce=' + Date.now() + '&offer_hash=Agq1Bpw7oX9&margin=50';

	var seal = CryptoJS.HmacSHA256(body, secret);

//	xhr.open('POST', 'https://www.paxful.com/api/offer/list');
//	xhr.setRequestHeader('Content-Type', 'text/plain');
//	xhr.setRequestHeader('Accept', 'application/json');
//	xhr.send(body + '&apiseal=' + seal);

//	$.ajax({
//		url:"https://www.paxful.com/api/offer/list"+body + '&apiseal=' + seal,
//		dataType:'jsonp',
//		data:'',
//		jsonp:'callback',
//		success:function(result) {
//			for(var i in result) {
//				alert(i+":"+result[i]);//循环输出a:1,b:2,etc.
//			}
//		},
//		timeout:3000
//	});


</script>