@extends('template')

@section('conteudo')
	<div class="jumbotron bg-dark text-white">
		<h1 class="display-4">Cadastro Itens de Vendas #{{ $venda->id }}</h1>
	</div>

	<form method="post" action="{{ route('vendas_item_add', ['id' => $vendas->id])}}">
		@csrf
	 <div class="form-row">
		<select name="id_produto" class="form-control">
			@foreach ($produtos as $p)
			<option value="{{ $p->id }}">{{ $p->nome }}</option>
			@endforeach
		</select>
    </div>
    <div class="form-row pt-3">
    	<input type="number" name="quantidade" class="form-control" min="0" step="0.01">
    </div>    
    <div class="form-group pt-3 col-md-12">
      <button type="submit" class="btn btn-success">Cadastrar</button>
    </div>
  </form>

  <div class="jumbotron bg-dark text-white">
    <h1 class="display-4">Material fornecido até agora</h1>
  </div>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>ID Item</th> 
        <th>Nome</th>
        <th>Quantidade</th>
        <th>Valor Unitario</th>   
        <th>Subtotal</th>
        <th>Data</th>
        <th>Operações</th>  
      </tr>
    </thead>
    <tbody class="thead-light">
      @foreach ($vendas->produtos as $p)
      <tr>
        <td>{{ $p->pivot->id }}</td>
        <td>{{ $p->nome }}</td>
        <td>{{ $p->pivot->quantidade}}</td>
        <td>{{ $p->preco}}</td>
        <td>{{ $p->pivot->subtotal}}</td>
        <td>{{ $p->pivot->created_at}}</td>
        <td><a href="#" class="btn btn-danger" onclick="exclui({{$p->id}})">Remover</a></td>
      </tr>
      @endForeach
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><b>Total: </b></td>
        <td><b>{{ $vendas->valor}}</b></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>

<a href="#" class="btn btn-alert">Fechar Venda</a>

  <script type="">
  	function exclui(id){
		if (confirm("Deseja excluir o item de id: " + id + "?")){
			location.href = "/venda/{{ $vendas->id }}/itens/remover/" + id;
		}
	}
  </script>
@endsection
