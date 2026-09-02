Funcionalidades do projeto
- **Gestão financeira**:
  - Lançamento de movimentações: registro detalhado de pagamentos, dívidas, receitas e receitas recorrentes.
  - Controle de parcelamentos: gerenciamento de compras parceladas com controle individual de parcelas e projeção de impactos nos meses futuros.

- **Visualização de Dados e Relatórios**:
  - Gráficos interativos: dashboards visuais que facilitam o acompanhamento da saúde financeira e distribuição de gastos.
  - Tabelas de análise: exibição estruturada dos lançamentos para consulta rápida.
  - Filtros por período customizados: filtragem avançada por datas para análise precisa de histórico mensal, anual ou intervalos personalizados.

Arquitetura e Organização do Código

O projeto adota uma arquitetura modularizada com separação clara de responsabilidades em 4 camadas:

- **Camada de Apresentação (`Views`):** Arquivos focados na renderização da interface do usuário e captura de eventos front-end.
- **Camada de Entidade (`Models`):** Mapeamento do objeto e suas propriedades (atributos, getters e setters).
- **Camada de Regras de Negócio (`Services`):** Funções e lógicas específicas para manipulação e validação dos dados do objeto.
- **Camada de Persistência (`DAO / Database`):** Isolamento de todas as consultas SQL utilizando PDO e Prepared Statements contra SQL Injection.
