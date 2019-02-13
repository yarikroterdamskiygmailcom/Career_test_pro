<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CategoriesDescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_description')->insert([
            [
                'category_id' => '1',
                'name' => 'Skills',
                'description' => "<p>Below 60 statements are set out that relate to a certain skill set. If you possess the mentioned skill or if you would like to acquire the skill, click <b>\'like\'</b>. If you don\'t possess the skill or if you would not necessarily like to develop it, click <b>\'neither like nor dislike\'</b>. If the skill doesn\'t appeal to you and you also wouldn\'t like to develop it, click <b>\'dislike\'</b>.</p>",
                'language_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => '3',
                'name' => 'Work values',
                'description' => "<p>Below 60 statements are set out that relate to work values, which are principles, motives or beliefs that are possibly important for you in a professional work environment. Knowing which work values are most important to you will help you make decisions about what jobs or career paths might suit you best. If the mentioned work value appeals to you, click <b>'like'</b>. If you don't necessarily like the work value or if you're not sure, click <b>'neither like nor dislike'</b>. If the work value doesn't appeal to you, click <b>'dislike'</b>.</p>",
                'language_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => '4',
                'name' => 'Activities',
                'description' => "<p>Below 60 statements are set out that relate to activities. If the mentioned activity appeals to you, click <b>'like'</b>, when your not sure, click <b>'neither like nor dislike'</b>. If the mentioned activity does not appeal to you, click <b>'dislike'</b>.</p>",
                'language_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => '5',
                'name' => 'Personal behavior',
                'description' => "<p>Below 60 statements are set out that relate to certain personal behaviors and attitudes. If the mentioned personality trait is applicable to you, click <b>'true'</b>. If the mentioned personality trait is not necessarily applicable to you or if your not sure, click <b>'neither true nor false'</b>. If the trait doesn't apply to you, click <b>'false'</b>.</p>",
                'language_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => '6',
                'name' => 'Occupations / Professions',
                'description' => "<p>Below 60 occupations are set out. If the mentioned occupation appeals to you, click <b>'like'</b>. If you don't necessarily like the occupation or if your not sure, click <b>'neither like nor dislike'</b>. If the mentioned occupation does not appeal to you, click <b>'dislike'</b>.</p>",
                'language_id' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => '1',
                'name' => 'Vaardigheden',
                'description' => "<p>Hieronder staan 60 uitspraken die betrekking hebben op vaardigheden. Indien je de beschreven vaardigheid bezit of deze graag zou willen ontwikkelen selecteer je <b>â€˜leukâ€™</b>, indien je de vaardigheid niet bezit en niet per se belangrijk vindt om te ontwikkelen, selecteer je <b>'weet ik niet'</b>. Wanneer de beschreven vaardigheid je niet aanspreekt en je geen interesse hebt om deze te ontwikkelen selecteer je <b>â€˜niet leukâ€™</b>.</p>
<br>Loop deze 60 uitspraken vluchtig door en denk niet te lang na over je antwoord.",
                'language_id' => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => '3',
                'name' => 'Werkwaarden',
                'description' => "<p>Hieronder staan 60 uitspraken die betrekking hebben op werkwaarden; dit zijn zaken die mogelijk belangrijk zijn voor jou en die jij graag terug wilt vinden in je werkzaamheden. Indien de beschreven werkwaarde je aanspreekt selecteer je <b>'leuk'</b>, indien je het niet per se belangrijk vindt of het niet zeker weet, selecteer je <b>'weet ik niet'</b>. Wanneer de werkwaarde je niet aanspreekt selecteer je <b>'niet leuk'</b>.</p>
<br>Loop deze 60 uitspraken vluchtig door en denk niet te lang na over je antwoord.",
                'language_id' => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => '4',
                'name' => 'Activiteiten',
                'description' => "<p>Hieronder staan 60 uitspraken. Deze uitspraken gaan over activiteiten. Het is aan jou om bij elke activiteit aan te geven of deze je aanspreekt. Indien de beschreven activiteit je aanspreekt selecteer je <b>'leuk'</b>, indien je het niet zeker weet, selecteer je <b>'weet ik niet'</b>. Wanneer de activiteit je niet aanspreekt selecteer je <b>'niet leuk'</b>.</p>
<br>Loop deze 60 uitspraken vluchtig door en denk niet te lang na over je antwoord.",
                'language_id' => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => '5',
                'name' => 'Persoonlijk gedrag',
                'description' => "<p>Hieronder staan 60 uitspraken die betrekking hebben op persoonlijk gedrag. Het is aan jou om bij elke uitspraak aan te geven in hoeverre het beschreven gedrag op jou van toepassing is. Indien het beschreven gedrag op jou van toepassing is  selecteer je <b>'waar'</b>, indien het beschreven gedragen niet per se op jou van toepassing is of je het niet precies weet, selecteer je <b>'weet ik niet'</b>. Wanneer het beschreven gedrag niet op jou van toepassing is selecteer je <b>'niet waar'</b>.</p>
<br>Loop deze 60 uitspraken vluchtig door en denk niet te lang na over je antwoord.",
                'language_id' => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'category_id' => '6',
                'name' => 'Beroepen',
                'description' => "<p>Hieronder staan 60 beroepen. Het is aan jou om bij elk beroep aan te geven of deze je aanspreekt. Indien het beschreven beroep je aanspreekt selecteer je <b>'leuk'</b>, indien je het niet zeker weet, selecteer je <b>'weet ik niet'</b>. Wanneer het beroep je niet aanspreekt selecteer je <b>'niet leuk'</b>.</p>
<br>Loop deze 60 beroepen vluchtig door en denk niet te lang na over je antwoord.",
                'language_id' => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
