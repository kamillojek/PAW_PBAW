{extends file="main.tpl"}
{* przy zdefiniowanych folderach nie trzeba już podawać pełnej ścieżki *}

{block name=footer}przykładowa tresć stopki wpisana do szablonu głównego z szablonu kalkulatora{/block}

{block name=content}

<h3>Prosty kalkulator</h2>


	<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
		<fieldset>
			<label for="id_kwota">Kwota kredytu: </label>
			<input id="id_kwota" type="text" name="kwota" placeholder="np. 100000 (zł)" value="{$form->kwota}" /> zł<br />
			<label for="id_oprocentowanie">Oprocentowanie: </label>
			<input id="id_oprocentowanie" type="text" name="oprocentowanie" placeholder="np. 5.3 (%)" value="{$form->oprocentowanie}" /> %<br />
			<label for="id_raty">Ile lat chcesz spłacać kredyt: </label>
			<input id="id_raty" type="text" name="raty" placeholder="np. 2 (lat)" value="{$form->raty}" /> lat<br />

		</fieldset>

		<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
	</form>

	<div class="messages">

		{* wyświeltenie listy błędów, jeśli istnieją *}
		{if isset($messages)}
			{if count($messages) > 0}
				<h4>Wystąpiły błędy: </h4>
				<ol class="err">
					{foreach  $messages as $msg}
						{strip}
							<li>{$msg}</li>
						{/strip}
					{/foreach}
				</ol>
			{/if}
		{/if}

		{* wyświeltenie listy informacji, jeśli istnieją *}
		{if isset($infos)}
			{if count($infos) > 0}
				<h4>Informacje: </h4>
				<ol class="inf">
					{foreach  $infos as $msg}
						{strip}
							<li>{$msg}</li>
						{/strip}
					{/foreach}
				</ol>
			{/if}
		{/if}

		{if isset($res->result)}
			<h4>Wynik</h4>
			<p class="res">
				{$res->result}
			</p>
		{/if}

	</div>

{/block}