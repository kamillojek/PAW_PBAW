{extends file="main.tpl"}

{block name=content}

<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$conf->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: {$user->login}, rola: {$user->role}</span>
</div>

<form action="{$conf->action_url}calcCompute" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_kwota">Kwota kredytu: </label>
			<input id="id_kwota" type="text" name="kwota" placeholder="np. 100000 (zł)" value="{$form->kwota}" /> zł<br />
		</div>
        <div class="pure-control-group">
			<label for="id_oprocentowanie">Oprocentowanie: </label>
			<input id="id_oprocentowanie" type="text" name="oprocentowanie" placeholder="np. 5.3 (%)" value="{$form->oprocentowanie}" /> %<br />
		</div>
        <div class="pure-control-group">
			<label for="id_raty">Ile lat chcesz spłacać kredyt: </label>
			<input id="id_raty" type="text" name="raty" placeholder="np. 2 (lat)" value="{$form->raty}" /> lat<br />
		</div>
		<div class="pure-controls">
			{if $user->role == "admin"}
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
			{/if}
		</div>
	</fieldset>
</form>	

{include file='messages.tpl'}

{if isset($res->result)}
<div class="messages info">
	Wynik: {$res->result}
</div>
{/if}

{/block}