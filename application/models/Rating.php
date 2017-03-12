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
             <p>Alle patriouilleleden hebben een taak: 10</p>',
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
             <p>Alle patriouilleleden zetten zich in: 10</p>',
            1,
            10
        );

        // Identiteit
        $this->add(
            'Identiteit',
            'Uniform',
            '<b>Uitgedrukt in totaal aantal missende onderdelen gedeeld door het aantal aanwezige patrioulleleden.</b>
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
            'Uniform',
            '<b>Uitgedrukt in totaal aantal missende onderdelen gedeeld door het aantal aanwezige patrioulleleden.</b>
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
}