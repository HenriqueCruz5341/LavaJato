<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<br></br>
		<h1 class="h2">Inserir Pessoas</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
			</div>
		</div>

		<?php
		if (isset($this->dados['msg'])) {
			echo $this->dados['msg'];

		}
		?>
	</div>

	<?php
	$listarRua = new ModelsPessoa();
	$listarRua->listarRua();
	$rua = $listarRua->getResult();
	?>

	<script>
		var fis = document.getElementById("iFisica");
		
		function myFunctionF() {
			var x = document.getElementById("iFisica");
			var jur = document.getElementById("iJuridica");
			jur.style.display = "none";
			if (x.style.display === "none") {
				x.style.display = "block";
			//} else {
			//	x.style.display = "none";
		}
	}

	function myFunctionJ() {
		var x = document.getElementById("iJuridica");
		var fis = document.getElementById("iFisica");
		fis.style.display = "none";
		if (x.style.display === "none") {
			x.style.display = "block";
		//} else {
		//	x.style.display = "none";
	}
}

function myFunctionStart() {
	var jur = document.getElementById("iJuridica");
	var fis = document.getElementById("iFisica");
	fis.style.display = "none";
	jur.style.display = "none";
}

function formatar(mascara, documento){
	var i = documento.value.length;
	var saida = mascara.substring(0,1);
	var texto = mascara.substring(i)

	if (texto.substring(0,1) != saida){
		documento.value += texto.substring(0,1);
	}

}
window.onload = myFunctionStart;
</script>



<form method="post" name="formCadastro" action="">
	<div class="form-row">
		<div class="form-group col-md-3">
			<label for="iEmail">E-mail</label>
			<input name="email" type="email" class="form-control" id="inputEmail" placeholder="E-mail" values="<?php if (isset($this->dados['email'])) {echo $this->dados['email'];}?>>">
		</div>
		<div class="form-group col-md-1">
			<label for="iSenha">Senha</label>
			<input name="senha" type="password" class="form-control" id="iSenha" placeholder="Senha" values="<?php if (isset($this->dados['senha'])) {echo $this->dados['senha'];}?>">
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-3">
			<label for="iRua">Rua</label>
			<select id="iRua" name="rua" class="form-control">
				<option value = "" selected disabled>Selecione uma opção</option>
				<?php
				foreach($rua as $linha) {
					echo '<option value='.$linha['idRua'].'>'.$linha['nomeRua'].'</option>';
				}
				?> 
			</select>
		</div>
		<div class="form-group col-md-1">
			<label for="iNumCasa">Número da casa</label>
			<input name="numeroCasa" type="text" class="form-control" id="iNumCasa" placeholder="Número da casa" values="<?php if (isset($this->dados['numeroCasa'])) {echo $this->dados['numeroCasa'];}?>">
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="iComplemento">Complemento</label>
			<input name="complemento" type="text" class="form-control" id="iComplemento" placeholder="Complemento" values="<?php if (isset($this->dados['complemento'])) {echo $this->dados['complemento'];}?>">
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-1">
			<label for="iDdd">DDD</label>
			<input name="ddd" type="number" min="0" max="999" step="1" class="form-control" id="iDdd" placeholder="DDD" values="<?php if (isset($this->dados['ddd'])) {echo $this->dados['ddd'];}?>">
		</div>
		<div class="form-group col-md-1">
			<label for="iTelefone">Telefone</label>
			<input name="telefone" type="tel" class="form-control" id="iTelefone" placeholder="Telefone" values="<?php if (isset($this->dados['telefone'])) {echo $this->dados['telefone'];}?>">
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-3">
			<input id="radioFis" type="radio" name="tipo" value="1" onclick="myFunctionF()" required>
			<label for="radioFis">Física</label>
			<input id="radioJur" type="radio" name="tipo" value="2" onclick="myFunctionJ()" required>
			<label for="radioJur">Jurídica</label>
		</div>
	</div>

	<div class="form-row" id="iFisica">
		<div class="form-group col-md-3" >
			<label for="inome">Nome Completo</label>
			<input name="nomeFisica" type="text" class="form-control" id="iNFisica" placeholder="Nome Completo" value="<?php if (isset($this->dados['nomeFisica'])) {echo $this->dados['nomeFisica'];}?>">
		</div>
		<div class="form-group col-md-1">
			<label for="iCPF">CPF</label>
			<input type="text" name="cpf" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" class="form-control" id="iCPF" placeholder="CPF" value="<?php if (isset($this->dados['cpf'])) {echo $this->dados['cpf'];}?>">
		</div>
	</div>

	<div class="form-row" id="iJuridica" >
		<div class="form-group col-md-3" >
			<label for="iNFantasia">Nome Fantasia</label>
			<input name="nomeFantasia" type="text" class="form-control" id="iNFantasia" placeholder="Nome Fantasia" value="<?php if (isset($this->dados['nomeFantasia'])) {echo $this->dados['nomeFantasia'];}?>">
		</div>
		<div class="form-group col-md-3">
			<label for="iRSocial">Razão Social</label>
			<input name="razaoSocial" type="text" class="form-control" id="iRSocial" placeholder="Razão Social" value="<?php if (isset($this->dados['razaoSocial'])) {echo $this->dados['razaoSocial'];}?>">
		</div>
		<div class="form-group col-md-2">
			<label for="iCNPJ">CNPJ</label>
			<input type="text" name="cnpj" maxlength="18" OnKeyPress="formatar('##.###.###/####-##', this)" class="form-control" id="iCNPJ" placeholder="CNPJ" value="<?php if (isset($this->dados['cnpj'])) {echo $this->dados['cnpj'];}?>">
		</div>
	</div>

	<button name="enviarInserirPessoa" type="submit" class="btn btn-primary">Cadastrar Pessoa</button>
</form>

</main>