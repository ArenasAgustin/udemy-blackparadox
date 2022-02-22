$("document").ready(function () {
  $("do_contact_form").on("submit", do_contact_form);
  // Function to process the form
  function do_contact_form(event) {
    event.preventDefault();

    let data = new FormData($("do_contact_form").get(0));

    let wrapper_msg = $(".wrapper_msg"),
      wrapper_contact_form = $(".wrapper_contact_form"),
      submit_button = $(".submit_button"),
      submit_button_default = submit_button.html();

    //Ajax
    $.ajax({
      url: "process/ajax.php",
      type: "post",
      dataType: "json",
      processData: false,
      contentType: false,
      data: data,
      beforeSend: () => {
        submit_button.html("Enviando...");
      },
    })
      .done((res) => {
        if (res.status === 200) {
          wrapper_msg.addClass("alert alert-success");
          wrapper_msg.html(res.msg);
          wrapper_contact_form.html(res.data);
        } else {
          wrapper_msg.addClass("alert alert-danger");
          wrapper_msg.html(res.msg);
          submit_button.html(submit_button_default);
        }
      })
      .always(() => {})
      .fail((err) => {
        wrapper_msg.html("Hubo un error en la petición");
        wrapper_msg.addClass("alert alert-danger");
        submit_button.html(submit_button_default);
      });
  }
});
