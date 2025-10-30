# Guia de Site Settings - Sistema de Configurações por Tenant

## 📚 Visão Geral

O sistema de **Site Settings** permite gerir textos, configurações e conteúdo customizável por tenant, perfeito para sites multi-tenant com diferentes propósitos (funerárias, auto-escolas, etc.).

## 🎯 Características

- ✅ Isolado por tenant
- ✅ Cache automático por tenant
- ✅ Organizado por grupos (hero, features, contact, etc.)
- ✅ Interface Filament para gestão fácil
- ✅ Helper function global para acesso rápido
- ✅ Valores padrão (fallback)
- ✅ Suporta múltiplos tipos (text, textarea, url, email, tel, number)

---

## 📁 Estrutura

### Model
```php
App\Models\SiteSetting
```

### Filament Resource
```
App\Filament\Resources\SiteSettings\SiteSettingResource
```

### Helper Function
```php
site_setting($key, $default = null)
```

---

## 💻 Como Usar

### 1. No Código PHP

```php
// Obter valor de uma configuração
$heroTitle = site_setting('hero.title', 'Título Padrão');

// Em Controllers, Actions, etc.
$email = site_setting('contact.email');
$phone = site_setting('contact.phone');
```

### 2. Em Blade Views

```blade
<h1>{{ site_setting('hero.title', 'Bem-vindo') }}</h1>

<p>{{ site_setting('hero.subtitle') }}</p>

<footer>
    {{ site_setting('footer.copyright', '© 2024 Todos os direitos reservados') }}
</footer>
```

### 3. Programaticamente (Model)

```php
use App\Models\SiteSetting;

// Obter valor
$value = SiteSetting::get('hero.title', 'Default');

// Definir valor
SiteSetting::set('hero.title', 'Novo Título', 'hero', 'text');
```

---

## 🎨 Organização por Grupos

As configurações são organizadas em grupos para facilitar a gestão:

| Grupo | Descrição | Exemplo de Uso |
|-------|-----------|----------------|
| `general` | Configurações gerais | Nome do site, mensagens gerais |
| `hero` | Secção Hero | Título, subtítulo principal |
| `features` | Secção Features | Textos de características |
| `about` | Sobre | Informação institucional |
| `contact` | Contacto | Email, telefone, morada |
| `footer` | Rodapé | Copyright, links, textos do footer |
| `meta` | SEO/Meta Tags | Meta description, keywords |

---

## 🔧 Gestão no Filament Admin

### Aceder

1. Login no admin Filament
2. Menu: **Configurações do Site**
3. Ver lista organizada por grupos

### Criar Nova Configuração

1. Click **New**
2. Preencher:
   - **Chave**: `hero.title` (identificador único)
   - **Grupo**: Selecionar secção
   - **Tipo**: text, textarea, url, email, tel, number
   - **Valor**: O texto/conteúdo
   - **Descrição**: Opcional, para documentar

---

## 🚀 Comandos Artisan

### Popular Configurações Padrão

```bash
# Interativo - escolher tenant
php artisan site-settings:populate

# Direto para um tenant específico
php artisan site-settings:populate 1
```

Este comando cria as configurações padrão para funerárias. Personalize depois no Filament.

---

## 🔑 Configurações Padrão (Funerárias)

| Chave | Grupo | Valor Padrão |
|-------|-------|--------------|
| `hero.title` | hero | Funerárias de Confiança |
| `hero.subtitle` | hero | Selecionamos as melhores... |
| `features.title` | features | Serviços Funerários Completos |
| `features.subtitle` | features | Encontre a funerária ideal... |
| `general.site_name` | general | Funerárias Portugal |
| `general.empty_state_message` | general | Nenhuma funerária encontrada |
| `meta.description` | meta | Encontre as melhores funerárias... |
| `contact.email` | contact | contato@funerarias.pt |
| `contact.phone` | contact | +351 XXX XXX XXX |
| `footer.copyright` | footer | © 2024 Funerárias Portugal... |

---

## 🎯 Exemplo: Adaptar para Auto-Escola

Para um site de auto-escolas, basta alterar no Filament:

```
hero.title: "Auto-Escolas de Confiança"
hero.subtitle: "Encontre a melhor auto-escola para tirar a sua carta"
features.title: "Cursos de Condução Completos"
general.empty_state_message: "Nenhuma auto-escola encontrada"
```

---

## ⚡ Cache

O sistema usa cache automático por tenant:

### Cache Key
```
site_settings_tenant_{tenant_id}
```

### Limpar Cache

```bash
# Limpar cache de configurações (junto com outros)
php artisan cache:clear
```

O cache é automaticamente limpo quando:
- Uma configuração é criada
- Uma configuração é atualizada
- Uma configuração é deletada

---

## 📝 Boas Práticas

### Naming Convention para Chaves

Use dot notation organizada:

✅ Bom:
```
hero.title
hero.subtitle
features.card1.title
contact.form.success_message
```

❌ Evitar:
```
heroTitle
HERO_SUBTITLE
contact_email_address
```

### Valores Padrão

Sempre forneça um valor padrão:

```php
site_setting('hero.title', 'Título Padrão')
```

Isso garante que o site funciona mesmo sem configurações definidas.

### Descrições

Adicione descrições úteis no Filament para documentar o que cada configuração faz:

```
Descrição: "Título principal exibido no hero da homepage. 
            Recomendado: 40-60 caracteres."
```

---

## 🔒 Isolamento por Tenant

Cada tenant vê apenas suas próprias configurações:

- **Tenant 1** (Funerárias): Vê suas configurações
- **Tenant 2** (Auto-Escolas): Vê configurações completamente diferentes
- **Cache isolado**: Cada tenant tem seu próprio cache

---

## 🛠️ Desenvolvimento

### Adicionar Novos Tipos

Edite o Form Schema em:
```
app/Filament/Resources/SiteSettings/Schemas/SiteSettingForm.php
```

Adicione no array de tipos:
```php
'json' => 'JSON',
'boolean' => 'Sim/Não',
'color' => 'Cor',
```

### Criar Grupos Personalizados

Adicione no select de grupos:
```php
'pricing' => 'Preços',
'testimonials' => 'Testemunhos',
'faq' => 'FAQ',
```

---

## 📊 Database Schema

```sql
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint unsigned NOT NULL,
  `key` varchar(255) NOT NULL,
  `group` varchar(255) DEFAULT 'general',
  `value` text,
  `type` varchar(255) DEFAULT 'text',
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_tenant_id_key_unique` (`tenant_id`,`key`),
  FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE
);
```

---

## 🎉 Vantagens

1. **Flexibilidade**: Cada tenant pode ter textos completamente diferentes
2. **Sem Código**: Alterar textos sem tocar no código
3. **Organizado**: Grupos facilitam encontrar configurações
4. **Performante**: Cache automático por tenant
5. **Type-Safe**: Helper function com fallback
6. **Multi-tenant**: Isolamento total entre tenants

---

## 📞 Suporte

Para adicionar novas configurações padrão, edite:
```
app/Console/Commands/PopulateSiteSettingsCommand.php
```

No método `getDefaultSettings()`.






