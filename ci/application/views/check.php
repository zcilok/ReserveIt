

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Clean Contact Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?=base_url('application/third_party/css/normalize.css')?>">

    
        <link rel="stylesheet" href="<?=base_url('application/third_party/css/style.css')?>">

    
    
    
  </head>

  <body>

    
<div class="container">
  <div class="row header">
    <h1>VERIFY QR CODE THERE &nbsp;</h1>
    <h3>Fill out the form below to check the QR code!</h3>
  </div>
  <div class="row body">
    <form action="<?=site_url('Test/verifyCode')?>" method="POST">
      <ul>
        
        <li>
          <p>
            <label for="Order_Number">Order Number</label>
            <input type="text" name="Order_Number" value="<?=$order_id?>">
          </p>
        </li>
        
        <li>
          <p>
            <label for="Verify_Code">Verify Code</label>
            <input type="text" name="Verify_Code">
          </p>
        </li>        
        <li><div class="divider"></div></li>
        
        <li>
          <input class="btn btn-submit" type="submit" value="Submit" />
        </li>
        
      </ul>
    </form>  
  </div>
</div>
    
    
    
    
    
  </body>
</html>
