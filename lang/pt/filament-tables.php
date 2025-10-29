<?php

return [

    'column_toggle' => [

        'heading' => 'Colunas',

    ],

    'columns' => [

        'text' => [

            'actions' => [
                'collapse_list' => 'Mostrar menos :count',
                'expand_list' => 'Mostrar mais :count',
            ],

            'more_list_items' => 'e mais :count',

        ],

    ],

    'fields' => [

        'bulk_select_page' => [
            'label' => 'Selecionar/desselecionar todos os itens para ações em massa.',
        ],

        'bulk_select_record' => [
            'label' => 'Selecionar/desselecionar o item :key para ações em massa.',
        ],

        'bulk_select_group' => [
            'label' => 'Selecionar/desselecionar o grupo :title para ações em massa.',
        ],

        'search' => [
            'label' => 'Pesquisar',
            'placeholder' => 'Pesquisar',
            'indicator' => 'Pesquisar',
        ],

    ],

    'summary' => [

        'heading' => 'Resumo',

        'subheadings' => [
            'all' => 'Todos os :label',
            'group' => 'Resumo de :group',
            'page' => 'Esta página',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'Média',
            ],

            'count' => [
                'label' => 'Contagem',
            ],

            'sum' => [
                'label' => 'Soma',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'Terminar reordenação de registos',
        ],

        'enable_reordering' => [
            'label' => 'Reordenar registos',
        ],

        'filter' => [
            'label' => 'Filtrar',
        ],

        'group' => [
            'label' => 'Agrupar',
        ],

        'open_bulk_actions' => [
            'label' => 'Ações em massa',
        ],

        'toggle_columns' => [
            'label' => 'Alternar colunas',
        ],

    ],

    'empty' => [

        'heading' => 'Nenhum :model encontrado',

        'description' => 'Crie um :model para começar.',

    ],

    'filters' => [

        'actions' => [

            'apply' => [
                'label' => 'Aplicar filtros',
            ],

            'remove' => [
                'label' => 'Remover filtro',
            ],

            'remove_all' => [
                'label' => 'Remover todos os filtros',
                'tooltip' => 'Remover todos os filtros',
            ],

            'reset' => [
                'label' => 'Repor',
            ],

        ],

        'heading' => 'Filtros',

        'indicator' => 'Filtros ativos',

        'multi_select' => [
            'placeholder' => 'Todos',
        ],

        'select' => [
            'placeholder' => 'Todos',
        ],

        'trashed' => [

            'label' => 'Registos eliminados',

            'only_trashed' => 'Apenas registos eliminados',

            'with_trashed' => 'Com registos eliminados',

            'without_trashed' => 'Sem registos eliminados',

        ],

    ],

    'grouping' => [

        'fields' => [

            'aggregate' => [
                'label' => 'Agregar',
                'placeholder' => 'Selecione um agregado',
            ],

            'average' => [
                'label' => 'Média',
            ],

            'count' => [
                'label' => 'Contagem',
            ],

            'sum' => [
                'label' => 'Soma',
            ],

        ],

    ],

    'reorder_indicator' => 'Arraste e solte os registos por ordem.',

    'selection_indicator' => [

        'selected_count' => '1 registo selecionado|:count registos selecionados',

        'actions' => [

            'select_all' => [
                'label' => 'Selecionar todos os :count',
            ],

            'deselect_all' => [
                'label' => 'Desselecionar todos',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'Ordenar por',
            ],

            'direction' => [

                'label' => 'Direção da ordenação',

                'options' => [
                    'asc' => 'Ascendente',
                    'desc' => 'Descendente',
                ],

            ],

        ],

    ],

    'pagination' => [

        'label' => 'Navegação de paginação',

        'overview' => '{1} A mostrar 1 resultado|[2,*] A mostrar :first a :last de :total resultados',

        'fields' => [

            'records_per_page' => [

                'label' => 'por página',

                'options' => [
                    'all' => 'Todos',
                ],

            ],

        ],

        'actions' => [

            'first' => [
                'label' => 'Primeira',
            ],

            'go_to_page' => [
                'label' => 'Ir para a página :page',
            ],

            'last' => [
                'label' => 'Última',
            ],

            'next' => [
                'label' => 'Seguinte',
            ],

            'previous' => [
                'label' => 'Anterior',
            ],

        ],

    ],

];


