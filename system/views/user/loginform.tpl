<div class="error">
	{$error}
</div>

<form method="post" action="{$href_base}/index.php?route=user/login">
	Username: <input type="text" name="username" value="{$username|escape}" /><br />
	Password: <input type="password" name="password" /><br />
	Remember me? <input type="checkbox" name="remember" value="true"{if $remember} checked{/if} /><br />
	<input type="submit" value="Login" />
</form>
