# Serviços Funerários - Laravel

Este projeto foi criado extraindo toda a estrutura HTML e CSS do tema React original, convertendo-o para um projeto Laravel funcional com Blade templates.

## Estrutura do Projeto

### Páginas Criadas
- **Home** (`/`) - Página inicial com hero section, funerárias em destaque e artigos do blog
- **Funerárias** (`/funerarias`) - Lista completa de todas as funerárias com paginação
- **Detalhes da Funerária** (`/funeraria/{id}`) - Página de detalhes com informações de contacto, avaliações e formulário
- **Quem Somos** (`/quem-somos`) - Página sobre a empresa com missão, valores e história
- **Detalhes do Blog** (`/post/{id}`) - Página de artigo individual com conteúdo completo
- **Política de Privacidade** (`/politica-privacidade`) - Página legal
- **Política de Cookies** (`/politica-cookies`) - Página legal
- **404** - Página de erro personalizada

### Componentes Blade
- `layouts/app.blade.php` - Layout principal com navbar e footer
- `components/navbar.blade.php` - Barra de navegação fixa
- `components/footer.blade.php` - Rodapé com links e informações
- `components/cookie-consent.blade.php` - Banner de consentimento de cookies
- `components/funeral-home-card.blade.php` - Card para exibir funerárias
- `components/blog-post-card.blade.php` - Card para exibir artigos do blog

### Estilos e Assets
- `resources/css/app.css` - CSS principal com variáveis CSS customizadas e Tailwind
- `resources/js/app.js` - JavaScript para funcionalidades interativas
- `tailwind.config.js` - Configuração do Tailwind CSS
- `public/images/logo.png` - Logo da empresa

## Funcionalidades Implementadas

### Design System
- **Cores**: Sistema de cores HSL com variáveis CSS
- **Tipografia**: Playfair Display para títulos, sistema para texto
- **Gradientes**: Gradientes personalizados para botões e backgrounds
- **Sombras**: Sombras elegantes e suaves
- **Animações**: Transições suaves e animações de fade-in

### Componentes Interativos
- **Navbar**: Navegação fixa com estados ativos
- **Cookie Consent**: Banner de consentimento com localStorage
- **Formulários**: Validação básica e feedback visual
- **Cards**: Hover effects e transições suaves
- **Pagination**: Navegação entre páginas

### Responsividade
- Design totalmente responsivo
- Breakpoints: mobile, tablet, desktop
- Grid layouts adaptativos
- Imagens responsivas

## Como Executar

1. **Instalar dependências**:
   ```bash
   composer install
   npm install
   ```

2. **Configurar ambiente**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Compilar assets**:
   ```bash
   npm run dev
   # ou para produção
   npm run build
   ```

4. **Executar servidor**:
   ```bash
   php artisan serve
   ```

## Tecnologias Utilizadas

- **Laravel 11+** - Framework PHP
- **Blade** - Template engine
- **Tailwind CSS** - Framework CSS
- **Vite** - Build tool
- **JavaScript Vanilla** - Interatividade

## Estrutura de Arquivos

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── components/
│   │   ├── navbar.blade.php
│   │   ├── footer.blade.php
│   │   ├── cookie-consent.blade.php
│   │   ├── funeral-home-card.blade.php
│   │   └── blog-post-card.blade.php
│   └── pages/
│       ├── home.blade.php
│       ├── funeral-homes.blade.php
│       ├── funeral-home-detail.blade.php
│       ├── about.blade.php
│       ├── blog-post-detail.blade.php
│       ├── privacy-policy.blade.php
│       ├── cookie-policy.blade.php
│       └── 404.blade.php
├── css/
│   └── app.css
└── js/
    └── app.js

routes/
└── web.php

public/
└── images/
    └── logo.png
```

## Características do Design

### Paleta de Cores
- **Primary**: Roxo (#7C3AED) - Cor principal
- **Secondary**: Amarelo (#F59E0B) - Cor de destaque
- **Accent**: Verde (#10B981) - Cor de apoio
- **Neutral**: Cinzas para texto e backgrounds

### Tipografia
- **Títulos**: Playfair Display (serif elegante)
- **Texto**: Sistema (sans-serif legível)

### Layout
- **Container**: Centralizado com max-width responsivo
- **Spacing**: Sistema consistente de espaçamentos
- **Grid**: Layout em grid para cards e seções

## Funcionalidades JavaScript

- **Cookie Consent**: Gerenciamento de consentimento de cookies
- **Smooth Scrolling**: Navegação suave para âncoras
- **Form Validation**: Validação básica de formulários
- **Interactive Elements**: Hover effects e transições

## Próximos Passos

Para tornar o projeto completamente funcional, considere:

1. **Backend**: Implementar models, controllers e database
2. **Autenticação**: Sistema de login/registro
3. **CMS**: Painel administrativo para gerenciar conteúdo
4. **API**: Endpoints para dados dinâmicos
5. **Testes**: Testes automatizados
6. **SEO**: Meta tags e otimizações
7. **Performance**: Otimizações de carregamento

O projeto está pronto para desenvolvimento e pode ser executado imediatamente com `php artisan serve` após a instalação das dependências.