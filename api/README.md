# Api Nota por Nota

## Instalação

###### É esperado que você já tenha baixado o repositório na sua máquina.

1. Criar um banco de dados Postgres (preferencialmente na versão 17) com o nome "nota-por-nota";
2. Copiar as variáveis de ambiente (`cp .env.example .env`);
3. Rodar as *migrations* com os `seeders` (`php artisan migrate --seed`);
4. Gerar a chave do aplicativo `php artisan key:generate`;
5. Acessar a seguinte URL no navegador: http://127.0.0.1:8000/. Se estiver tudo certo, é para aparecer a tela padrão do Laravel.

### Documentação

Para gerar a documentação pelo swagger, rode o seguinte comando: `php artisan l5-swagger:generate`.
