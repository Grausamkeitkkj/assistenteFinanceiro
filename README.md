🏗️ Arquitetura e Organização do Código

O projeto adota uma arquitetura modularizada com separação clara de responsabilidades em 4 camadas:

- **Camada de Apresentação (`Views`):** Arquivos focados na renderização da interface do usuário e captura de eventos front-end.
- **Camada de Entidade (`Models`):** Mapeamento do objeto e suas propriedades (atributos, getters e setters).
- **Camada de Regras de Negócio (`Services`):** Funções e lógicas específicas para manipulação e validação dos dados do objeto.
- **Camada de Persistência (`DAO / Database`):** Isolamento de todas as consultas SQL utilizando PDO e Prepared Statements contra SQL Injection.
