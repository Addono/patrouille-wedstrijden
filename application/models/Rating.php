<?php

/**
 * @author Adriaan Knapen <a.d.knapen@protonmail.com>
 * @date 11-3-2017
 */

/**
 * Class Rating
 * @property CI_DB_query_builder $db
 */
class Rating extends ModelFrame
{

    const FIELD_ID = 'id';
    const FIELD_SUBJECT = 'subject';
    const FIELD_DESCRIPTION = 'description';
    const FIELD_AREA = 'area';
    const FIELD_WEEK = 'week';
    const FIELD_FACTOR = 'score_factor';
    const FIELD_HERTEN = 'score_herten';
    const FIELD_EKSTERS = 'eksters';
    const FIELD_KEMPHANEN = 'kemphanen';
    const FIELD_UILEN = 'uilen';

    public function getWeek($week) {
        return $this->db
            ->where([self::FIELD_WEEK => $week])
            ->get(self::name())
            ->result_array();
    }

    public function add($area, $subject, $description, $week, $factor) {
        return $this->db
            ->insert(
                self::name(),
                [
                    self::FIELD_AREA => $area,
                    self::FIELD_SUBJECT => $subject,
                    self::FIELD_DESCRIPTION => $description,
                    self::FIELD_WEEK => $week,
                    self::FIELD_FACTOR => $factor,
                ]
            );
    }

    public function v1() {
        $typeScore = [
            'type' => 'ENUM("unknown", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10")',
            'default' => 'unknown'
        ];
        return [
            'add' => [
                self::FIELD_ID => [
                    'type' => 'primary',
                ],
                self::FIELD_AREA => [
                    'type' => 'ENUM("Sport en spel", "Identiteit", "Uitdagende scoutingtechnieken", "Expressie", "Buitenleven", "Internationaal", "Samenleving", "Veilig en gezond")',
                    'default' => 'Sport en spel',
                ],
                self::FIELD_SUBJECT => [
                    'type' => 'VARCHAR',
                    'constraint' => NAME_LENGTH,
                ],
                self::FIELD_DESCRIPTION => [
                    'type' => 'TEXT',
                ],
                self::FIELD_WEEK => [
                    'type' => 'ENUM("1", "2", "3", "4")',
                    'default' => '1',
                ],
                self::FIELD_FACTOR => [
                    'type' => 'INT',
                    'constraint' => 3,
                    'unsigned' => TRUE,
                ],
                self::FIELD_HERTEN => $typeScore,
                self::FIELD_EKSTERS => $typeScore,
                self::FIELD_KEMPHANEN => $typeScore,
                self::FIELD_UILEN => $typeScore,
            ],
        ];
    }

    public function v2() {
        // Sport en spel
        $this->add(
            'Sport en spel',
            'Samenwerking',
            '<p>Niet iedereen heeft een taak: 3</p>
             <p>De meeste patrouilleleden hebben een taak: 6</p>
             <p>Alle patrouilleleden hebben een taak: 10</p>',
            1,
            5
        );
        $this->add(
            'Sport en spel',
            'Strategie',
            '<p>Er is geen strategie: 1</p>
             <p>Er is een strategie, maar deze wordt niet uitgevoerd: 5</p>
             <p>Er is een strategie en deze wordt duidelijk uitgevoerd: 10</p>',
            1,
            5
        );
        $this->add(
            'Sport en spel',
            'Inzet',
            '<p>Geen van de patrouilleleden zet zich in: 3</p>
             <p>De meeste patrouilleleden zetten zich in: 6</p>
             <p>Alle patrouilleleden zetten zich in: 10</p>',
            1,
            10
        );
        $this->add(
            'Sport en spel',
            'Resultaat',
            '<p>1ste plaats: 10 punten</p>
            <p>2de plaats: 7 punten</p>
            <p>3de plaats: 4 punten</p>
            <p>4de plaats: 1 punt</p>',
            1,
            10
        );

        // Identiteit
        $this->add(
            'Identiteit',
            'Uniform',
            '<b>Uitgedrukt in totaal aantal missende onderdelen gedeeld door het aantal aanwezige patrouilleleden.</b>
             <p>Exact 0 (er ontbreekt niks): 10</p>
             <p>Tussen de 0 en 1: 8</p>
             <p>Tussen de 1 en 2: 6</p>
             <p>Tussen de 2 en 3: 4</p>
             <p>Tussen de 3 en 4: 2</p>
             <p>Tussen de 4 en 5: 0</p>',
            1,
            10
        );
        $this->add(
            'Identiteit',
            'Ploegoptreden',
            '<b>10 punten, min 2 voor elk van de volgende onderdelen die niet gehaald worden</b>
            <p>Iedereen staat stil</p>
            <p>Iedereen houd z\'n mond</p>
            <p>Iedereen heeft z\'n blouse in z\'n broek</p>
            <p>Iedereen heeft z\'n das goed</p>
            <p>Iedereen heeft z\'n mouwen opgerold</p>',
            1,
            10
        );
        $this->add(
            'Identiteit',
            'De wet',
            '<b>10 punten, min 2 voor het noemen van de titel en min 1 voor elke fout opgezegde regel</b><br>
            <i>Let op: De wet moet uit het hoofd opgezegd worden.</i>',
            1,
            10
        );
    }

    public function v3() {
        // Week 2
        $this->add(
            'Uitdagende scoutingtechnieken',
            'Routetechniek',
            '<b>Per gehaalde etappe 2 punten</b>',
            2,
            20
        );
        $this->add(
            'Sport en spel',
            'Samenwerking',
            '<p>Niet iedereen heeft de route gelezen: 2</p>
            <p>De meeste patrouilleleden hebben de route gelezen: 7</p>
            <p>Alle patrouilleleden hebben de route gelezen: 10</p>',
            2,
            10
        );
        $this->add(
            'Veilig en gezond',
            'Fietsen',
            '<p>De patrouille blijft bij elkaar: +5 punten</p>
            <p>De Patrouille houdt zich aan de verkeersregels: +5 punten</p>',
            2,
            20
        );
    }

    public function v4() {
        // Week 3
        // Identiteit
        $this->add(
            'Identiteit',
            'Uniform',
            '<b>Uitgedrukt in totaal aantal missende onderdelen gedeeld door het aantal aanwezige patrouilleleden.</b>
             <p>Exact 0 (er ontbreekt niks): 10</p>
             <p>Tussen de 0 en 1: 8</p>
             <p>Tussen de 1 en 2: 6</p>
             <p>Tussen de 2 en 3: 4</p>
             <p>Tussen de 3 en 4: 2</p>
             <p>Tussen de 4 en 5: 0</p>',
            3,
            10
        );
        $this->add(
            'Identiteit',
            'Ploegoptreden',
            '<b>10 punten, min 2 voor elk van de volgende onderdelen die niet gehaald worden</b>
            <p>Iedereen staat stil</p>
            <p>Iedereen houd z\'n mond</p>
            <p>Iedereen heeft z\'n blouse in z\'n broek</p>
            <p>Iedereen heeft z\'n das goed</p>
            <p>Iedereen heeft z\'n mouwen opgerold</p>',
            3,
            10
        );

        // Expressie
        $this->add(
            'Expressie',
            'Thema inleving',
            '<p>De hele patroulle neemt het thema serieus en gaan er in mee: 10</p>
            <p>De meeste patrouilleleden nemen het thema serieus: 8</p>
            <p>De helft van de pattroulleleden neemt het thema serieus: 5</p>
            <p>Bijna niemand neemt het thema serieus: 2</p>
            <p>Niemand neemt het thema serieus: 0</p>',
            3,
            20
        );
        $this->add(
            'Expressie',
            'Prestatie op de posten',
            '<b>Alle patrouilles worden beoordeeld op prestatie en inzet op de posten.</b>
            <p>1ste plaats: 10 punten</p>
            <p>2de plaats: 7 punten</p>
            <p>3de plaats: 4 punten</p>
            <p>4de plaats: 1 punt</p>',
            3,
            10
        );
    }

    public function v5() {
        // Veilig en gezond
        $this->add(
            'Veilig en gezond',
            'Koken',
            '<p>Degenen die met eten werken hebben schone handen: +3 punten</p>
            <p>Er wordt hygiënisch gewerkt in de keuken: +3 punten</p>
            <p>Degene die het vuur stookt werkt <b>niet</b> aan het eten: +2 punten</p>
            <p>Er wordt gelet op veiligheid omtrend vuur en kookgerei: +2 punten</p>',
            4,
            15
        );
        $this->add(
            'Veilig en gezond',
            'Gerecht',
            '<p>Alle ingredienten worden gebruikt (voor kruiden in proportionele maten): +3 punten</p>
            <p>Het volledige gerecht is gaar: +3 punten</p>
            <p>De maaltijd is voldoende op smaak: +2 punten</p>
            <p>Ruimte voor creativiteit (bv. presentatie van het gerecht): 0/+1/+2 punten</p>',
            4,
            10
        );

        // Uitdagende scoutingtechnieken
        $this->add(
            'Uitdagende scoutingtechnieken',
            'Tent',
            '<p>Tent is goed gespannen: +2 punten</p>
             <p>Kan de tent goed dicht: +2 punten</p>
             <p>Haringen staan op een rechte lijn: +2 punten</p>
             <p>Slikranden zitten netjes: +2 punten</p>
             <p>De tent is opgeruimt: +2 punten</p>',
            4,
            20
        );
        $this->add(
            'Uitdagende scoutingtechnieken',
            'Vuur',
            '<p>Het vuur op de vuurtafel is geschikt om te koken: +2 punten</p>
            <p>Er is een houtvoorraad aangelegd: +2 punten</p>
            <p>De kookstaven liggen stabiel: +3 punten</p>
            <p>Er is gedacht aan een blusmogelijkheid (pan/jerrycan): +3 punten</p>',
            4,
            10
        );
        $this->add(
            'Uitdagende scoutingtechnieken',
            'Vuurtafel',
            '<p>De vuurtafel is behoorlijk/zeer stevig: +2/+4 punten</p>
             <p>De vuurtafel is voorzien van plaggen: +3 punten</p>
             <p>Er ligt voldoende zand op de vuurtafel: +3 punten</p>',
            4,
            10
        );
        $this->add(
            'Uitdagende scoutingtechnieken',
            'Keuken',
            '<p>De keuken is redelijk/behoorlijk/zeer stevig: +1/+2/+4 punten</p>
             <p>Het werkblad is recht: +2 punten</p>
             <p>Er is een gevulde jerrycan: +2 punt</p>
             <p>Er is een bestekrek: +1 punt</p>
             <p>Er is een pannenrek: +1 punt</p>',
            4,
            15
        );
        $this->add(
            'Uitdagende scoutingtechnieken',
            'Materiaalzorg',
            '<p>Het materiaal wordt gebruikt waarvoor het bedoeld is: +2 punten</p>
             <p>Er wordt niet over materiaal gelopen: +2 punten</p>
             <p>Materiaal ligt niet verspreid over het terrein: +2 punten</p>
             <p>Materiaal is goed opgeborgen (schoon en ingevet mits nodig): +2 punten</p>
             <p>Er wordt veilig met het materiaal gewerkt: +2 punten</p>',
            4,
            10
        );
        $this->add(
            'Buitenleven',
            'Afvalsortering',
            '<p>Het afval wordt gesorteert: 10 punten</p>
            <p>Het merendeel van het afval wordt gesorteerd: 6 punten</p>
            <p>Er wordt niet aan afvalscheiding gedaan: 1 punt</p>',
            4,
            5
        );
    }
}