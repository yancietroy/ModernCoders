<?php
if (isset($_SESSION['sweetalert'])) {
  $alert = $_SESSION['sweetalert'];
  $title = $alert["title"] ?? "Success!";
  $text = $alert["text"] ?? "";
  $icon = $alert["icon"] ?? "";

  if ($alert["redirect"] != null) {
    $redirect = $alert['redirect'];
    echo "
        <script>
          Swal.fire({
            title: '$title',
            text: '$text',
            icon: '$icon',
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = '$redirect';
            }
          });
        </script>
      ";
  } else {
    echo "
        <script>
          Swal.fire({
            title: '$title',
            text: '$text',
            icon: '$icon'
          });
        </script>
      ";
  }
  unset($_SESSION['sweetalert']);
}
