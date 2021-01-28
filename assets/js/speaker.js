$(document).ready(function () {
  let allow = $("#customSwitch1[type='checkbox']").is(":checked");
  if (allow) {
    let header = $(".header-line").innerText;
    responsiveVoice.speak(`We are navigated to ${header} page`);
  } else {
    responsiveVoice.pause();
  }

  $(".tts").mouseenter(function () {
    let allow = $("#customSwitch1[type='checkbox']").is(":checked");
    if (allow) {
      responsiveVoice.speak(this.innerText);
    } else {
      responsiveVoice.pause();
    }
  });

  $(".btn-tts").on("mouseenter", function () {
    let allow = $("#customSwitch1[type='checkbox']").is(":checked");
    if (allow) {
      responsiveVoice.speak(`Click here to ${this.innerText}`);
    } else {
      responsiveVoice.pause();
    }
  });

  $(".a-tts").on("mouseenter", function () {
    let allow = $("#customSwitch1[type='checkbox']").is(":checked");
    if (allow) {
      responsiveVoice.speak(`Click here to navigate to ${this.innerText} page`);
    } else {
      responsiveVoice.pause();
    }
  });

  $(".menu-tts").on("mouseenter", function () {
    let allow = $("#customSwitch1[type='checkbox']").is(":checked");
    if (allow) {
      let page = $("a.menu-tts").attr("alt");
      console.log(page);
      responsiveVoice.speak(
        `${this.innerText}. Click here to navigate to ${page} page`
      );
    } else {
      responsiveVoice.pause();
    }
  });

  $("#showPassword a").on("click", function (event) {
    event.preventDefault();
    if ($("#showPassword input").attr("type") == "text") {
      $("#showPassword input").attr("type", "password");
      $("#showPassword i").addClass("fa-eye-slash");
      $("#showPassword i").removeClass("fa-eye");
    } else if ($("#showPassword input").attr("type") == "password") {
      $("#showPassword input").attr("type", "text");
      $("#showPassword i").removeClass("fa-eye-slash");
      $("#showPassword i").addClass("fa-eye");
    }
  });

  $("#showRepeat a").on("click", function (event) {
    event.preventDefault();
    if ($("#showRepeat input").attr("type") == "text") {
      $("#showRepeat input").attr("type", "password");
      $("#showRepeat i").addClass("fa-eye-slash");
      $("#showRepeat i").removeClass("fa-eye");
    } else if ($("#showRepeat input").attr("type") == "password") {
      $("#showRepeat input").attr("type", "text");
      $("#showRepeat i").removeClass("fa-eye-slash");
      $("#showRepeat i").addClass("fa-eye");
    }
  });

  $("#showOld a").on("click", function (event) {
    event.preventDefault();
    if ($("#showOld input").attr("type") == "text") {
      $("#showOld input").attr("type", "password");
      $("#showOld i").addClass("fa-eye-slash");
      $("#showOld i").removeClass("fa-eye");
    } else if ($("#showOld input").attr("type") == "password") {
      $("#showOld input").attr("type", "text");
      $("#showOld i").removeClass("fa-eye-slash");
      $("#showOld i").addClass("fa-eye");
    }
  });

  $("#showNew a").on("click", function (event) {
    event.preventDefault();
    if ($("#showNew input").attr("type") == "text") {
      $("#showNew input").attr("type", "password");
      $("#showNew i").addClass("fa-eye-slash");
      $("#showNew i").removeClass("fa-eye");
    } else if ($("#showNew input").attr("type") == "password") {
      $("#showNew input").attr("type", "text");
      $("#showNew i").removeClass("fa-eye-slash");
      $("#showNew i").addClass("fa-eye");
    }
  });
});
