$(function(){
  // 送信ボタンがクリックされたら、送信ボタンを非活性化する（二重submit対策）
  $('form').submit(function() {
    $("button[type='submit']").prop("disabled", true);
  });
});