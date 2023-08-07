{{-- Afim de não repetir código de formulários, nós criamos um partial e centralizamos os códigos repetidos --}}

@csrf()

{{-- O valor old('') serve para buscar o ultimo dado digitado,
caso a requisição falhe e retorne algum erro, não será necessário digitar tudo novamente. --}}
<input type="text" placeholder="Assunto" name="subject" value="{{ $support->subject ?? old('subject') }}">
<textarea name="body" cols="30" rows="5" placeholder="Descrição">{{ $support->body ?? old('body') }}</textarea>
<button type="submit">Enviar</button>
