<?php

namespace App\Console\Commands;

use App\Models\SiteSetting;
use App\Models\Tenant;
use Illuminate\Console\Command;

class PopulateSiteSettingsCommand extends Command
{
    protected $signature = 'site-settings:populate {tenant_id?}';

    protected $description = 'Popular configurações padrão do site para um tenant';

    public function handle(): int
    {
        $tenantId = $this->argument('tenant_id');

        if (! $tenantId) {
            $tenants = Tenant::query()->get();

            if ($tenants->isEmpty()) {
                $this->error('Nenhum tenant encontrado!');

                return self::FAILURE;
            }

            $options = $tenants->pluck('name', 'id')->toArray();
            $tenantId = $this->choice('Selecione o tenant:', $options);
        }

        $tenant = Tenant::query()->find($tenantId);

        if (! $tenant) {
            $this->error("Tenant {$tenantId} não encontrado!");

            return self::FAILURE;
        }

        config(['app.current_tenant_id' => $tenant->id]);

        $this->info("Populando configurações para: {$tenant->name}");

        $defaultSettings = $this->getDefaultSettings();

        $bar = $this->output->createProgressBar(count($defaultSettings));
        $bar->start();

        foreach ($defaultSettings as $setting) {
            SiteSetting::query()->updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info('✓ Configurações populadas com sucesso!');

        return self::SUCCESS;
    }

    private function getDefaultSettings(): array
    {
        return [
            [
                'key' => 'hero.title',
                'group' => 'hero',
                'value' => 'Funerárias de Confiança',
                'type' => 'text',
                'description' => 'Título principal da homepage',
            ],
            [
                'key' => 'hero.subtitle',
                'group' => 'hero',
                'value' => 'Selecionamos as melhores funerárias com serviços de excelência para apoiar sua família neste momento.',
                'type' => 'textarea',
                'description' => 'Subtítulo da homepage',
            ],
            [
                'key' => 'features.title',
                'group' => 'features',
                'value' => 'Serviços Funerários Completos',
                'type' => 'text',
                'description' => 'Título da secção de features',
            ],
            [
                'key' => 'features.subtitle',
                'group' => 'features',
                'value' => 'Encontre a funerária ideal para as necessidades da sua família',
                'type' => 'text',
                'description' => 'Subtítulo da secção de features',
            ],
            [
                'key' => 'general.site_name',
                'group' => 'general',
                'value' => 'Funerárias Portugal',
                'type' => 'text',
                'description' => 'Nome do site',
            ],
            [
                'key' => 'general.empty_state_message',
                'group' => 'general',
                'value' => 'Nenhuma funerária em destaque encontrada.',
                'type' => 'text',
                'description' => 'Mensagem quando não há resultados',
            ],
            [
                'key' => 'meta.description',
                'group' => 'meta',
                'value' => 'Encontre as melhores funerárias em Portugal. Serviços funerários completos com profissionalismo e respeito.',
                'type' => 'textarea',
                'description' => 'Meta description do site',
            ],
            [
                'key' => 'contact.email',
                'group' => 'contact',
                'value' => 'contato@funerarias.pt',
                'type' => 'email',
                'description' => 'Email de contacto principal',
            ],
            [
                'key' => 'contact.phone',
                'group' => 'contact',
                'value' => '+351 XXX XXX XXX',
                'type' => 'tel',
                'description' => 'Telefone de contacto',
            ],
            [
                'key' => 'footer.copyright',
                'group' => 'footer',
                'value' => '© 2024 Funerárias Portugal. Todos os direitos reservados.',
                'type' => 'text',
                'description' => 'Texto de copyright no footer',
            ],
            [
                'key' => 'faq.title',
                'group' => 'general',
                'value' => 'Perguntas Frequentes',
                'type' => 'text',
                'description' => 'Título da secção de FAQs na homepage',
            ],
        ];
    }
}
