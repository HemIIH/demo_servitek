<?php

use Illuminate\Database\Seeder;

class TextBlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('textblocks')->insert([
            [
                'type'  => 'signature',
                'name'  => 'company_name',
                'label' => 'Firmenname',
                'value' => 'Servite GmbH',
            ],
            [
                'type'  => 'signature',
                'name'  => 'street',
                'label' => 'Straße',
                'value' => 'Hohenzollenring 57',
            ],
            [
                'type'  => 'signature',
                'name'  => 'postal_code',
                'label' => 'PLZ',
                'value' => '50672',
            ],
            [
                'type'  => 'signature',
                'name'  => 'city',
                'label' => 'Stadt',
                'value' => 'Köln',
            ],
            [
                'type'  => 'signature',
                'name'  => 'email',
                'label' => 'E-Mail',
                'value' => 'info@servite.de',
            ],
            [
                'type'  => 'signature',
                'name'  => 'phone',
                'label' => 'Telefon',
                'value' => '0221 16025 152',
            ],
            [
                'type'  => 'signature',
                'name'  => 'fax',
                'label' => 'Fax',
                'value' => '0221 16867 124',
            ],
            [
                'type'  => 'signature',
                'name'  => 'website',
                'label' => 'Webseite',
                'value' => 'www.servite.de',
            ],
            [
                'type'  => 'signature',
                'name'  => 'iban',
                'label' => 'IBAN',
                'value' => 'DE24 3704 0044 0129 7639 00',
            ],
            [
                'type'  => 'signature',
                'name'  => 'bic',
                'label' => 'BIC',
                'value' => 'COBADEFFXXX',
            ],
            [
                'type'  => 'signature',
                'name'  => 'tax_number',
                'label' => 'Steuernummer',
                'value' => '123/4354/1212',
            ],
            [
                'type'  => 'signature',
                'name'  => 'tax_id',
                'label' => 'Umsatzsteuer ID',
                'value' => 'DE4354684354',
            ],
            [
                'type'  => 'operation_plan',
                'name'  => 'disclaimer',
                'label' => 'Hinweise',
                'value' => '<p>Der Mitarbeiter wird als Leiharbeitnehmer bei Kunden im Rahmen der Arbeitnehmerüberlasung eingesetzt.
                            <br />Bei allen Veranstaltungen ist die Uniform immer komplett und sauber mitzuführen. Bitte immer an Arbeitsutensilien wie Kellnermesser, Kugelschreiber, Block und Feuerzeug denken!</p>
                            <ul>
                            <li>Mit jeder Bestätigung des Einsatzes verpflichtet sich der/die Mitarbeiter/-in im Auftrag der Servite GmbH pünktlich beim Kunden oder am Treffpunkt zu erscheinen.</li>
                            <li>Emails müssen immer schriftlich bestätigt werden.</li>
                            <li>Einsätze enden nicht mit der letzten Bahn.</li>
                            <li>Absagen werden ausschließlich telefonisch von Servite entgegengenommen.</li>
                            <li>Während der Arbeit ist das Handy auszuschalten oder auf Flugmodus umzustellen</li>
                            </ul>',
            ],
            [
                'type'  => 'operation_plan',
                'name'  => 'signature',
                'label' => 'Signatur',
                'value' => ' <p>Mit besten Grüßen, <br />Payam R. Monfared, Chem. Ing. <br /><br />
                            Email: pmonfared@servite.de<br />
                            Tel: 0178 - 888 - 3058<br /> <br /> 
                            Servite GmbH<br /> 
                            Hohenzollernring 57<br /> 
                            50672 Köln<br /> <br /> 
                            Tel.: 0221/16025-152<br /> Fax: 0221/16867 124<br /> <br /> 
                            E-Mail: info@servite.de<br /> www: www.servite.de<br /> <br /> 
                            Geschäftsführer: Georg Hüwel und Dino Pergola<br /> <br /> HR 82474, Registergericht Köln<br /> 
                            Steuernummer: 215/5839/3539<br /> UST-ID: DE29 724 6540<br /> <br /> 
                            Diese E-Mail enthält vertrauliche und/oder rechtlich geschützte Informationen. Wenn Sie nicht der richtige Adressat sind oder diese E-Mail irrtümlich erhalten haben, informieren Sie bitte sofort den Absender und vernichten Sie diese E-Mail. Das unerlaubte Kopieren sowie die unbefugte Weitergabe dieser E-Mail ist nicht gestattet.<br /> <br /> 
                            This e-mail may contain confidential and/or privileged information. If you are not the intended recipient (or have received this e-mail in error) please notify the sender immediately and destroy this e-mail. Any unauthorised copying, disclosure or distribution of the material in this e-mail is strictly forbidden.</p>'
            ],
            [
                'type'  => 'attendance_list',
                'name'  => 'mail_body',
                'label' => 'Mail - Anschreiben',
                'value' => '<p>Sehr geehrte Damen und Herren,</p>
                            <p>anbei senden wir Ihnen die Stundenzettel zur Ihrer Veranstaltung. Bitte senden Sie uns diese schnellstmöglich nach Beendigung des Events unterschrieben zurück.</p>
                            <p>Vielen Dank für Ihren Auftrag.</p>
                            ',
            ],
            [
                'type'  => 'attendance_list',
                'name'  => 'header',
                'label' => 'Kopfbereich',
                'value' => ' <p>Der Verleiher verpflichtet sich, dem Entleiher die in dieser Anwesenheitsliste aufgeführten Arbeitnehmer zur Arbeitnehmerleistung zu überlassen. Die Arbeitnehmerüberlassung gilt für die</p>',
            ],
            [
                'type'  => 'attendance_list',
                'name'  => 'call_to_action',
                'label' => 'Anweisung',
                'value' => '<p>Bitte Trainees (TR) und Standby (STB) nach vier Stunden auschecken. Bei länger andauernden Einsätzen werden die Folgestunden berechnet.</p>
                            <p><strong>Unterschrift Auftraggeber:</strong>............................................................. (Bitte Namen auch in Druckbuchstaben angeben)</p>
                            <p>Bitte senden Sie uns diese Anwesenheitsliste nach Veranstaltungsende an folgende Faxnummer: 0221 - 16867 124 oder per E-Mail an fax@servite.de</p>',
            ],
            [
                'type'  => 'attendance_list',
                'name'  => 'disclaimer',
                'label' => 'Hinweise',
                'value' => '</p>Der Entleiher verpflichtet sich, die sich aus § 618 BGB ergebenden Fürsorgepflichten einzuhalten. Insbesondere wird darauf geachtet, dass die Unfallverhütungsvorschriften Beachtung finden. Der Entleiher verpflichtet sich zur Unterrichtung, der für seinen Betrieb geltenden Arbeitsschutz- und Unfallverhütungsvorschriften. Der Verleiher übernimmt keine Verpflegungskosten. Der Entleiher akzeptiert die AGB der Servite GmbH.</p>',
            ],
            [
                'type'  => 'invoice',
                'name'  => 'mail_body',
                'label' => 'Mail - Anschreiben',
                'value' => '<p>Sehr geehrte Damen und Herren,</p>
                            <p>wir bedanken uns für die gute Zusammenarbeit und stellen Ihnen wie vereinbart folgende Leistungen in Rechnung. Rechnung und Stundennachweis sind beigefügt als PDF.</p>',
            ],
            [
                'type'  => 'invoice',
                'name'  => 'intro',
                'label' => 'Rechnung - Einleitender Text',
                'value' => '<p>Wir bedanken uns für die gute Zusammenarbeit und stellen Ihnen wie vereinbart folgende Leistungen in Rechnung.</p>',
            ],
            [
                'type'  => 'invoice',
                'name'  => 'outro',
                'label' => 'Rechnung - Schließender Text',
                'value' => '<p>Innerhalb von 14 Tagen ab Rechnungsdatum netto ohne Abzug.</p>
                            <p>Bitte geben Sie als Verwendungszweck unbedingt die Rechnungs-Nr. an.</p>',
            ],
            [
                'type'  => 'invoice',
                'name'  => 'reminder',
                'label' => 'Zahlungserinnerung',
                'value' => '<p>Sehr geehrte Damen und Herren,<br /><br />
                            nach Durchsicht unserer Konten haben wir festgestellt, dass die Rechnung anbei noch offen ist.<br /><br />
                            Wir bitten um schnellstmöglichen Ausgleich der Rechnung auf unser Konto<br /><br />Sollte sich diese Zahlungserinnerung mit Ihrer Zahlung überschnitten haben, bitten wir, dieses Schreiben als gegenstandslos zu betrachten.</p>',
            ],
            [
                'type'  => 'invoice',
                'name'  => 'payment_period',
                'label' => 'Zahlungsfrist (in Tagen)',
                'value' => '14',
            ],
            [
                'type'  => 'client_warning',
                'name'  => 'mail_body',
                'label' => 'Mail - Anschreiben',
                'value' => 'Sehr geehrter Herr ..., ',
            ],
            [
                'type'  => 'document',
                'name'  => 'subject',
                'label' => 'Mail - Betreff',
                'value' => 'Ihre Unterlagen',
            ],
            [
                'type'  => 'document',
                'name'  => 'mail_body',
                'label' => 'Mail - Anschreiben',
                'value' => 'Sehr geehrter Herr ..., ',
            ]
        ]);
    }
}
