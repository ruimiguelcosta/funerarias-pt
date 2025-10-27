<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Este seeder cria configurações de exemplo. Execute em modo manual após selecionar o tenant.');

        $defaultSettings = [
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
        ];

        foreach ($defaultSettings as $setting) {
            SiteSetting::query()->updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
