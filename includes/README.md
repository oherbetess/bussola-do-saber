# 🧭 Bússola do Saber
> **Projeto de Extensão Acadêmica**  

Olá! Este é o meu projeto de extensão acadêmica. A **Bússola do Saber** é uma plataforma que criei para ajudar estudantes a encontrarem cursos gratuitos de qualidade, organizarem seus certificados e compartilharem suas opiniões sobre o que aprenderam.

## 💡 Por que este projeto?
Como estudante, sei que existem muitos cursos bons na internet, mas eles ficam espalhados e muitas vezes não sabemos se o conteúdo é realmente bom. A ideia da Bússola é centralizar esses "nortes" educacionais e permitir que a própria comunidade avalie as aulas através de estrelas e comentários.

---

## 🛠️ O que a plataforma faz?
- **Catálogo de Cursos:** Lista cursos gratuitos com descrição breve, instituição e link direto.
- **Sistema de Avaliação:** Usuários logados podem dar notas (1 a 5 estrelas) e deixar comentários reais.
- **Área do Aluno (Meu Perfil):** Um espaço para o estudante fazer o upload e guardar seus certificados (PDF/Imagem) de forma organizada.
- **Painel Administrativo:** Uma área restrita para eu (ou outros admins) cadastrar, editar e organizar os cursos.
- **Segurança:** Sistema de login com níveis de acesso e troca de senha protegida.

---

## 💻 Tecnologias que utilizei
Para desenvolver este projeto do zero, utilizei:
- **PHP 8:** Para toda a lógica do sistema e comunicação com o banco.
- **MySQL:** Para armazenar os usuários, cursos e avaliações.
- **HTML5 & CSS3:** Para criar uma interface escura (Dark Mode), moderna e responsiva para celular.
- **JavaScript:** Para funções de interface, como mostrar/esconder senhas.

---

## ⚠️ Segurança e Credenciais (Importante!)

Para proteger o meu banco de dados, eu **não subi** o arquivo `conexao.php` original com as minhas senhas para o GitHub. 

Se você clonar este projeto, siga estes passos para configurar:
1. Localize o arquivo `includes/conexao.php.example`.
2. Renomeie ele para **`conexao.php`**.
3. Abra o arquivo e coloque as credenciais do seu banco de dados local (geralmente usuário `root` e senha vazia no XAMPP, ou seu banco de dados virtual).

Isso garante que cada desenvolvedor use suas próprias chaves sem expor as senhas de produção de ninguém! 🔒

---

## 🚀 Como rodar o projeto na sua máquina
1. Clone este repositório.
2. Certifique-se de ter um servidor local (como XAMPP ou Laragon) ou vitual como a InfinityFree.
3. Crie um banco de dados chamado `bussola_do_saber`.
4. Importe o arquivo `database.sql` (disponível na raiz do projeto) para criar as tabelas automaticamente.
5. Crie uma pasta chamada `uploads/` na raiz do projeto para que o salvamento de certificados funcione.
6. Configure o `conexao.php` como explicado acima.
7. Acesse `localhost/bussola-do-saber` no seu navegador!

---

- **Acesse a Bússola do saber:** [https://bussola.oiatech.com.br]
## 🎓 Contato e Feedback
Este projeto é um trabalho que passará por melhorias, sinta-se a vontade para fazer sugestões sobre ele.

- **Email:** [herbete.dev@gmail.com]
- **LinkedIn:** [www.linkedin.com/in/oherbetess]