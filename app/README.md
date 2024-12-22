# Nota por Nota App

## Instalação

###### É esperado que você já tenha baixado o repositório na sua máquina.

1. Baixar as dependências (´flutter pub get´);
2. Copiar as variáveis de ambiente (`cp .env.example .env`);
3. Definir as variáveis de ambiente com os "*additional run args*" com o valor `--dart-define-from-file=.env`.

### Passo a passo para definir os *run args*

1. No Android Studio, clicar em "main.dart";
2. Clicar em *edit configuration*;
3. No campo *additional run args*, adicionar o valor `--dart-define-from-file=.env`.
4. Mais especificações [nesse artigo da Medium](https://medium.com/@nayanbabariya/set-up-environment-variables-in-flutter-for-secure-and-scalable-apps-7409ae0c383e).