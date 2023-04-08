<!DOCTYPE html>
<html>

<head>
  <title>Register</title>
</head>

<body>
  <h1>Register</h1>
  <?php if ($this->session->flashdata('error')) : ?>
    <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
  <?php endif; ?>
  <?php echo form_open('auth/register'); ?>
  <p>Username: <input type="text" name="username" value="<?php echo set_value('username'); ?>"></p>
  <?php echo form_error('username'); ?>
  <p>Email: <input type="email" name="email" value="<?php echo set_value('email'); ?>"></p>
  <?php echo form_error('email'); ?>
  <p>Password: <input type="password" name="password"></p>
  <?php echo form_error('password'); ?>
  <p>Role: <select name="role">
      <option value="admin">Admin</option>
      <option value="user">User</option>
    </select></p>
  <?php echo form_error('role'); ?>
  <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
  <p><input type="submit" value="Register"></p>
  <?php echo form_close(); ?>
  <p><a href="<?php echo base_url('auth/login'); ?>">Login</a></p>
</body>

</html>