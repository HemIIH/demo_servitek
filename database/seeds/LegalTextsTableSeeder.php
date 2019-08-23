<?php

use Illuminate\Database\Seeder;

class LegalTextsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('legal_texts')->insert([
            [
                'type'     => 'igz',
                'sub_type' => 'Entgelttarifvertrag',
                'section'  => 'scope',
                'title'    => 'Geltungsbereich',
                'body'     => '
                    <p>Dieser Tarifvertrag gilt:</p>
                    <p>1. räumlich für das Gebiet der Bundesrepublik Deutschland,</p>
                    <p>2. fachlich für alle ordentlichen Mitglieder des Interessenverbandes Deutscher Zeitarbeitsunternehmen (iGZ e.V.),</p>
                    <p>3. persönlich für alle Arbeitnehmer, die im Rahmen der Arbeitnehmerüberlassung an Kundenbetriebe überlassen werden und Mitglied einer der vertragsschließenden Gewerkschaften sind.</p>
                    
                    <p>Der Tarifvertrag findet keine Anwendung auf Zeitarbeitsunternehmen und -unternehmensteile, die mit dem Kundenunternehmen einen Konzern im Sinne des § 18 Aktiengesetz bilden, wenn</p>
                    <p>a) das Zeitarbeitsunternehmen in einem ins Gewicht fallenden Maße zuvor beim Kundenunternehmen beschäftigte Arbeitnehmer übernimmt und</p>
                    <p>b) die betroffenen Arbeitnehmer auf ihrem ursprünglichen oder einem vergleichbaren Arbeitsplatz im Kundenunternehmen eingesetzt werden und</p>
                    <p>c) dadurch bestehende im Kundenunternehmen wirksame Entgelttarifverträge zuungunsten der betroffenen Arbeitnehmer umgangen werden.</p>
                    
                    <p>Die in diesem Vertragstext verwendete Bezeichnung „Arbeitnehmer“ umfasst weibliche und männliche Beschäftigte. Sie wird ausschließlich aus Gründen der besseren Lesbarkeit verwendet.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Entgelttarifvertrag',
                'section'  => 'special_regulation',
                'title'    => '§3 Sonderregelung',
                'body'     => '
                    <p>Für Arbeitnehmer, die in Betriebe in den Bundesländern Mecklenburg-Vorpommern, Brandenburg, Berlin, Sachsen-Anhalt, Thüringen und Sachsen überlassen werden, richten sich die Entgelte nach den in diesem Tarifvertrag abgebildeten Entgelttabellen Ost.</p>
                    <p>Ab 01. April 2021 wird der Geltungsbereich der Entgelttabelle West auf das gesamte Bundesgebiet erweitert. Damit entfällt die bisherige Entgelttabelle Ost. Der letzte Anpassungsschritt der Ost/West-Angleichung erfolgt im Rahmen der nächsten Entgelttarifverhandlungen.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Entgelttarifvertrag',
                'section'  => 'betterment_agreement',
                'tilte'    => '§4 Besserstellungsvereinbarung',
                'body'     => '
                    <p>Zwischen den Tarifvertragsparteien dieses Tarifvertrages und dem Arbeitgeber des Kundenbetriebes kann eine tarifliche Regelung zur Vergütung der Einsatzzeiten in diesem Kundenbetrieb getroffen werden (dreiseitige Vereinbarung), wenn diese für die dort eingesetzten Mitarbeiter des Zeitarbeitsunternehmens günstiger ist.</p> 
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Entgelttarifvertrag',
                'section'  => 'inception_termination',
                'title'    => '§5 Inkrafttreten und Kündigung',
                'body'     => '
                    <p>Dieser Vertrag tritt am 01. Januar 2017 für alle tarifgebundenen Mitglieder der Vertragsparteien in Kraft und kann mit einer Frist von sechs Monaten zum Monatsende, erstmals jedoch zum 31. Dezember 2019, gekündigt werden.<p/> 
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Entgelttarifvertrag',
                'section'  => 'severability_clause',
                'title'    => '§6 Salvatorische Klausel',
                'body'     => '
                    <p>Sollten einzelne Bestimmungen dieses Vertrages, gleich aus welchem Grund, unwirksam sein oder werden, so soll hierdurch die Gültigkeit der übrigen Bestimmungen des Vertrages nicht berührt werden. Anstelle der unwirksamen Bestimmung soll jene angemessene Bestimmung treten, die dem am nächsten kommt, was die Parteien nach Sinn und Zweck des Vertrages gewollt haben.</p> 
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Entgelttarifvertrag',
                'section'  => 'notes',
                'title'    => 'Protokllnotizen',
                'body'     => '
                    <p>1. Der Tarifvertrag entfaltet keine Bindung für Fördermitglieder des iGZ.</p>
                    <p>2. Im gegenseitigen Einvernehmen können Ergänzungen jederzeit vorgenommen werden.</p>
                    <p>3. Durch den Tarifvertrag werden gesetzliche Mindestlohnansprüche nach dem ArbeitnehmerEntsendegesetz nicht berührt.</p>
                    <p>Berlin, den 30. November 2016</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'scope',
                'title'    => '§1 Geltungsbereich',
                'body'     => '
                    <p>Dieser Tarifvertrag gilt:</p>
                    <p>1. räumlich für das Gebiet der Bundesrepublik Deutschland,</p>
                    <p>2. fachlich für alle ordentlichen Mitglieder des Interessenverbandes Deutscher Zeitarbeitsunternehmen (iGZ e.V.),</p>
                    <p>3. persönlich für alle Arbeitnehmer, die im Rahmen der Arbeitnehmerüberlassung an Kundenbetriebe überlassen werden und Mitglied einer der vertragsschließenden Gewerkschaften sind.</p>
                    <p>Der Tarifvertrag findet keine Anwendung auf Zeitarbeitsunternehmen und -unternehmensteile, die mit dem Kundenunternehmen einen Konzern im Sinne des § 18 Aktiengesetz bilden, wenn</p>
                    <p>a) das Zeitarbeitsunternehmen in einem ins Gewicht fallenden Maße zuvor beim Kundenunternehmen beschäftigte Arbeitnehmer übernimmt und</p>
                    <p>b) die betroffenen Arbeitnehmer auf ihrem ursprünglichen oder einem vergleichbaren Arbeitsplatz im Kundenunternehmen eingesetzt werden und</p>
                    <p>c) dadurch bestehende im Kundenunternehmen wirksame Entgelttarifverträge zuungunsten der betroffenen Arbeitnehmer umgangen werden.</p>
                    <p>Die in diesem Vertragstext verwendete Bezeichnung „Arbeitnehmer“ umfasst weibliche und männliche Beschäftigte. Sie wird ausschließlich aus Gründen der besseren Lesbarkeit verwendet.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'employment',
                'title'    => '§2 Beginn und Ende des Beschäftigungsverhältnisses',
                'body'     => '
                    <h4>2.1. Arbeitsvertrag und Altersgrenze</h4>
                    <p>Der Arbeitgeber hat mit dem Arbeitnehmer einen schriftlichen Arbeitsvertrag abzuschließen. Erscheint der Arbeitnehmer am ersten Arbeitstag nicht und benachrichtigt den Arbeitgeber nicht unverzüglich über die Verhinderung am ersten Arbeitstag, so gilt das Beschäftigungsverhältnis als nicht zustande gekommen.</p>
                    <p>Das Beschäftigungsverhältnis endet mit dem Ablauf des Kalendermonats, in dem der Arbeitnehmer erstmals Anspruch auf ungekürzte Regelaltersrente nach den Bestimmungen der gesetzlichen Rentenversicherung hat oder haben würde, wenn er in der gesetzlichen Rentenversicherung versichert wäre.</p>
                    <h4>2.2. Probezeit und Kündigungsfristen</h4>
                    <p>Die ersten sechs Monate des Beschäftigungsverhältnisses gelten als Probezeit. In den ersten vier Wochen der Probezeit kann das Beschäftigungsverhältnis mit einer Frist von 2 Arbeitstagen gekündigt werden. Von der fünften Woche an bis zum Ablauf des zweiten Monats beträgt die Kündigungsfrist 1 Woche, vom dritten Monat bis zum sechsten Monat des Beschäftigungsverhältnisses 2 Wochen.</p>
                    <p>Vom siebten Monat des Beschäftigungsverhältnisses an gelten die gesetzlichen Kündigungsfristen. Diese gesetzlichen Kündigungsfristen gelten beiderseits.</p>
                    <p>Probezeit und Kündigungsfristen gelten gleichermaßen für befristete Beschäftigungsverhältnisse.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'working_hours',
                'title'    => '§3 Arbeitszeit',
                'body'     => '
                    <h4>3.1. Arbeitszeit</h4>
                    <p>3.1.1. Die individuelle regelmäßige monatliche Arbeitszeit beträgt für Vollzeitbeschäftigte 151,67 Stunden. Das entspricht einer durchschnittlichen wöchentlichen Arbeitszeit von 35 Stunden. Teilzeitarbeit liegt vor, wenn die vertraglich vereinbarte Arbeitszeit des Arbeitnehmers geringer ist als die tarifliche Arbeitszeit eines Vollzeitbeschäftigten. Teilzeitbeschäftigte haben im Rahmen ihres Arbeitsvertrages die gleichen tariflichen Rechte und Pflichten wie Vollzeitbeschäftigte, soweit sich aus den Tarifverträgen nichts anderes ergibt.
                    <p>3.1.2. Die individuelle regelmäßige Arbeitszeit pro Monat richtet sich nach der Anzahl der Arbeitstage.
                    <p>In Monaten mit
                    <ul>
                        <li>20 Arbeitstagen beträgt die Monatsarbeitszeit 140 Std.</li>
                        <li>21 Arbeitstagen beträgt die Monatsarbeitszeit 147 Std.</li>
                        <li>22 Arbeitstagen beträgt die Monatsarbeitszeit 154 Std.</li>
                        <li>23 Arbeitstagen beträgt die Monatsarbeitszeit 161 Std.</li>
                    </ul>
                    <p>Bei Teilzeitarbeit berechnet sich die regelmäßige Arbeitszeit pro Monat anteilig.</p>
                    <p>3.1.3. Die monatliche Arbeitszeit wird an die des Entleihers angepasst. Beginn und Ende der täglichen Arbeitszeit einschließlich der Pausen und die Verteilung der Arbeitszeit auf die einzelnen Wochentage richten sich nach den im jeweiligen Entleiherbetrieb gültigen Regelungen bzw. Anforderungen des Entleihers.</p>
                    <p>Die Tarifvertragsparteien sind darüber einig, dass die Anpassung der monatlichen Arbeitszeit an die des Entleihbetriebes gem. § 3.1.3 Manteltarifvertrag auch auf Zeiten der Betriebsruhe beim Entleihbetrieb Anwendung finden kann. In diesen Fällen können die Regelungen des § 7.2 Manteltarifvertrag analog angewendet werden mit der Maßgabe, dass ein dadurch verursachtes negatives Arbeitszeitkontensaldo, das über 21 Minusstunden hinausgeht, bei Beendigung des Arbeitsverhältnisses nicht mit Entgeltansprüchen verrechnet werden darf bzw. nicht zurückgezahlt werden muss.</p>
                    <p>Berechtigte Wünsche der Arbeitnehmer bezüglich der Lage und der Aufteilung zwischen Belastung des Arbeitszeitkontos und Urlaub oder eines alternativen Einsatzes sind nach Möglichkeit zu berücksichtigen.</p>
                    <p>3.1.4. Bei Einsatz in vollkontinuierlicher Schichtarbeit (Contischicht) oder einem vergleichbaren anderen Schichtmodell des Entleihers gilt für den Arbeitnehmer das Arbeitszeit-/Zuschlagsmodell des Entleihers nur, wenn ein voller Zyklus durchlaufen wird. Wird kein voller Zyklus durchlaufen, gilt für diesen Zeitraum der Durchschnitt der monatlichen Arbeitszeit zur Berechnung der geleisteten Stunden.</p>
                    <p>3.1.5. An Heiligabend und Silvester endet die Arbeitszeit um 14.00 Uhr. Für Arbeiten darüber hinaus gilt die Zuschlagsregelung für Feiertage. Beide Tage können unabhängig von den Bestimmungen gemäß § 3.2.3 über das Arbeitszeitkonto oder das Urlaubskonto als freie Tage entgolten werden.</p>
                    <h4>3.2. Arbeitszeitkonto</h4>
                    <p>3.2.1. Für jeden Arbeitnehmer wird ein Arbeitszeitkonto eingerichtet. Auf dieses Konto werden die Stunden übertragen, die über die regelmäßige Arbeitszeit pro Monat hinaus abgerechnet werden. Zulässig ist gleichermaßen die Übertragung von Minusstunden.</p>
                    <p>3.2.2. Es dürfen nur so viele Stunden auf das Arbeitszeitkonto übertragen werden, dass die Grenzwerte von maximal 150 Plusstunden und 21 Minusstunden nicht überschritten werden. Bei Teilzeitbeschäftigung wird die Plusstundenobergrenze der Arbeitszeitkonten im Verhältnis zur arbeitsvertraglich vereinbarten Arbeitszeit angepasst.</p> 
                    <p>3.2.3. Die auf dem Arbeitszeitkonto aufgelaufenen Stunden werden in der Regel durch Freizeit ausgeglichen (vgl. PN 8). Dabei können der Arbeitgeber und der Arbeitnehmer in jedem Kalendermonat über jeweils zwei Arbeitstage Zeitguthaben frei verfügen. Eine Verfügung durch den Arbeitgeber darf nicht zu einem negativen Zeitguthaben des Arbeitnehmers führen.</p>
                    <p>Die Freizeitgewährung ist spätestens 2 Arbeitstage vor Antritt vom Arbeitnehmer beim Arbeitgeber zu beantragen und kann nur aus dringenden betrieblichen Gründen abgelehnt werden. In einem solchen Falle hat der Arbeitgeber innerhalb von 4 Wochen</p>
                    <p>dem Freizeitersuchen nachzukommen. Eine vom Arbeitnehmer beanspruchte Freistellung zum Abbau von Guthabenstunden aus dem Arbeitszeitkonto wird nicht durch Zuteilung eines neuen Einsatzes unterbrochen. Bei Arbeitsunfähigkeit während eines beanspruchten Freizeitausgleichs werden Zeiten auf das Arbeitszeitkonto rückübertragen.</p>
                    <p>Darüber hinaus erfolgt der Freizeitausgleich nach den Wünschen des Arbeitnehmers in Absprache mit dem Arbeitgeber und unter Berücksichtigung betrieblicher Belange. Der Freizeitausgleich ist durch den Arbeitnehmer zu beantragen und bedarf der Genehmigung durch den Arbeitgeber.</p>
                    <p>3.2.4. Bei Ausscheiden wird ein positives Zeitguthaben ausgezahlt, ein negatives Zeitguthaben wird mit Entgeltansprüchen verrechnet bzw. ist zurückzuzahlen. Der Arbeitgeber hat dem Arbeitnehmer die Möglichkeit zu geben, ein negatives Zeitguthaben auch durch Arbeit auszugleichen.</p>
                    <p>3.2.5. Nach Ausspruch einer Kündigung ist der Arbeitgeber berechtigt, den Arbeitnehmer unter Fortzahlung seines Entgeltes und unter Anrechnung etwaiger Urlaubsansprüche und Guthaben aus dem Arbeitszeitkonto freizustellen. Im Falle iner betriebsbedingten Kündigung ist eine Freistellung zum Abbau des Arbeitszeitkontos nur mit Zustimmung des Arbeitnehmers möglich.</p> 
                    <p>3.2.6. Die Zulagen und Zuschläge werden jeweils mit dem Entgelt für den Monat ausgezahlt, in dem sie anfallen und werden nicht auf das Arbeitszeitkonto übertragen. Die Auszahlung der Stunden aus dem Arbeitszeitkonto erfolgt stets nur in Höhe der tariflichen Eingangsstufe ohne erücksichtigung von Branchenzuschlägen und sonstigen Zulagen und Zuschlägen.</p> 
                    <p>3.2.7. Auf Verlangen des Arbeitnehmers werden Stunden aus dem Arbeitszeitkonto, die über 105 Plusstunden hinausgehen, ausbezahlt. Bei Teilzeitbeschäftigten richtet sich die Anzahl der Plusstunden anteilig nach der jeweils arbeitsvertraglich vereinbarten Arbeitszeit.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'surcharges',
                'title'    => '§4 Zuschläge',
                'body'     => '
                    <h4>4.1. Mehrarbeit</h4>
                    <p>4.1.1. Mehrarbeit ist die über die regelmäßige monatliche Arbeitszeit hinausgehende Arbeitszeit.</p>
                    <p>4.1.2. Mehrarbeitszuschläge werden für Zeiten gezahlt, die in Monaten mit</p>
                    <ul>
                        <li>20 Arbeitstagen über 160 geleistete Stunden</li>
                        <li>21 Arbeitstagen über 168 geleistete Stunden</li>
                        <li>22 Arbeitstagen über 176 geleistete Stunden</li>
                        <li>23 Arbeitstagen über 184 geleistete Stunden</li>                
                    </ul>
                    <p>hinausgehen.</p>
                    <p>Der Mehrarbeitszuschlag beträgt 25 Prozent.</p>
                    <p>Diese Regelungen gelten gleichermaßen für Teilzeitbeschäftigte.</p>
                    <h4>4.2. Nachtarbeit</h4>
                    <p>Zuschläge für Nachtarbeit werden für Arbeit in der Zeit von 23.00 bis 6.00 Uhr gewährt, sofern mehr als 2 Stunden innerhalb dieser Nachtzeit gearbeitet wurde. Der Zuschlag für Nachtarbeit beträgt 25 Prozent. Regelmäßige Nachtarbeit (Dauernachtschicht) wird mit einem Zuschlag von 20 Prozent vergütet.</p>
                    <p>Für Tätigkeiten, die aus sachlichen Gründen typischerweise nachts verrichtet werden müssen (z.B. Bewachungsdienste), werden keine Zuschläge vergütet.</p>
                    <h4>4.3. Sonntagsarbeit</h4>
                    <p>Der Zuschlag für Sonntagsarbeit beträgt 50 Prozent, sofern die Arbeit an Sonntagen nicht zur Regelarbeitszeit zählt (vgl. PN 7).</p>
                    <h4>4.4. Feiertagsarbeit</h4>
                    <p>Der Zuschlag für Feiertagsarbeit beträgt 100 Prozent, sofern die Arbeit an Feiertagen nicht zur Regelarbeitszeit zählt (vgl. PN 7).</p>
                    <p>Es gilt die gesetzliche Feiertagsregelung am jeweiligen Einsatzort.</p>
                    <h4>4.5. Sonstige Zuschlagsvereinbarungen</h4>
                    <p>4.5.1. Treffen mehrere Zuschläge für die gleiche Arbeitszeit zusammen, so wird nur der jeweils höhere Zuschlag gezahlt.</p>
                    <p>4.5.2. Die prozentuale Zuschlagsberechnung bezieht sich auf die Vergütung gemäß aktueller Entgeltgruppe und -stufe gemäß § 2 des Entgelttarifvertrages. Die Zuschlagsberechnung bezieht sich nicht auf die einsatzbezogene Zulage oder etwaige außertarifliche Zulagen.</p>
                    <p>4.5.3. Abweichend von den Ziffern 4.1. bis 4.4. werden für Tätigkeiten im medizinischen/ärztlichen Bereich folgende Zuschläge vereinbart:</p>
                    <ul>
                        <li>Nachtarbeit 15,0 Prozent</li>
                        <li>Sonntagsarbeit 25,0 Prozent</li>
                        <li>Feiertagsarbeit 35,0 Prozent</li>
                        <li>Samstagsarbeit in der  Zeit von 13.00–23.00 Uhr 7,5 Prozent</li>
                    </ul>
                    <p>4.5.4. Abweichend von den Ziffern 4.1. bis 4.4. richten sich für Tätigkeiten im gastronomischen Bereich die Zuschläge für Nacht-, Sonn- und Feiertagsarbeit nach der jeweiligen Zuschlagsregelung im Entleihbetrieb.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'time_off',
                'title'    => '§5 Arbeitsbefreiung',
                'body'     => '
                    <p>5.1. Soweit dieser Tarifvertrag nichts anderes bestimmt, gilt der Grundsatz, dass nur geleistete Arbeit vergütet wird.</p> 
                    <p>5.2. In unmittelbarem Zusammenhang mit den nachstehenden Ereignissen ist dem Arbeitnehmer bezahlte Freistellung von der Arbeit ohne Anrechnung auf den Urlaub zu gewähren:
                    <p>a) bei eigener Eheschließung oder Eintragung einer eingetragenen Lebensgemeinschaft 1 Tag</p> 
                    <p>b) bei Niederkunft der Ehefrau 1 Tag</p> 
                    <p>c) bei Tod des mit dem Arbeitnehmer in häuslicher Gemeinschaft lebenden Ehegatten oder eingetragenen Lebenspartners 2 Tage</p>
                    <p>d) bei Tod eines Elternteils oder eines Kindes 1 Tag</p>
                    <p>e) bei Umzug auf Veranlassung des Arbeitgebers 1 Tag</p>
                    <p>f) bei Erfüllung gesetzlich auferlegter Pflichten aus öffentlichen Ehrenämtern für die notwendige ausfallende Arbeitszeit. Soweit Erstattungsanspruch besteht, entfällt in dieser Höhe der Anspruch auf das Arbeitsentgelt.</p>
                    <p>Bezüglich der Buchstaben b), c) und d) gelten die Regelungen entsprechend auch für Arbeitnehmer in eheähnlicher Lebensgemeinschaft.</p>
                    <p>Die Ansprüche auf Freistellung nach Buchstaben a) bis d) bestehen nach einer Betriebszugehörigkeit von 6 Monaten.</p>
                    <p>Bezahlte Freistellung wird auf vorherigen schriftlichen Antrag gewährt und ist vom Arbeitnehmer mit Dokumenten nachzuweisen. Der Nachweis ist spätestens innerhalb von zwei Wochen nach dem Ereignis beizubringen.</p>
                    <p>Damit sind alle Anlässe aus § 616 BGB kompensiert.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'holiday',
                'title'    => '§6 Urlaub',
                'body'     => '
                    <h4>6.1. Urlaubsgewährung</h4>
                    <p></p>Die Urlaubsgewährung richtet sich nach den Regelungen des Bundesurlaubsgesetzes. Urlaubstermine können jeweils nur im Einvernehmen mit dem Arbeitgeber festgelegt werden.
                    <h4>6.2. Urlaubsanspruch</h4>
                    <p>6.2.1. Der Urlaubsanspruch des Arbeitnehmers erhöht sich mit zunehmender Dauer der Betriebszugehörigkeit.</p>
                    <p>Der Arbeitnehmer erhält, berechnet nach der Dauer des ununterbrochenen Bestehens des Arbeitsverhältnisses (vgl. PN 5;6)</p>
                    <ul>
                        <li>im ersten Jahr einen Jahresurlaub von 24 Arbeitstagen,</li>
                        <li>im zweiten Jahr einen Jahresurlaub von 25 Arbeitstagen,</li>
                        <li>im dritten Jahr einen Jahresurlaub von 26 Arbeitstagen,</li>
                        <li>im vierten Jahr einen Jahresurlaub von 28 Arbeitstagen,</li>
                        <li>ab dem fünften Jahr einen Jahresurlaub von 30 Arbeitstagen.</li>
                    </ul>
                    <p>Bei Ausscheiden innerhalb der ersten sechs Monate des Bestehens des Beschäftigungsverhältnisses erwirbt der Arbeitnehmer Urlaubsanspruch gemäß Bundesurlaubsgesetz.</p>
                    
                    <p>Bezahlte Freistellung wird auf vorherigen schriftlichen Antrag gewährt und ist vom Arbeitnehmer mit Dokumenten nachzuweisen. Der Nachweis ist spätestens innerhalb von zwei Wochen nach dem Ereignis beizubringen.
                    <p>6.2.2. Für Teilzeitbeschäftigte ist der Jahresurlaub anteilig zu berechnen.</p>
                    <p>6.2.3. Scheidet der Arbeitnehmer im Laufe eines Kalenderjahres aus dem Unternehmen aus oder tritt er im Laufe eines Kalenderjahres ein, so erhält er für jeden vollen Monat des Bestehens des Beschäftigungsverhältnisses ein Zwölftel des ihm zustehenden Jahresurlaubs.</p>
                    <p>6.2.4. Der Urlaubsanspruch erlischt nach Ablauf des Kalenderjahres, wenn er nicht zuvor erfolglos geltend gemacht wurde oder aus betrieblichen Gründen oder wegen Krankheit nicht genommen werden konnte. In den genannten Fällen wird der Resturlaub in das Folgejahr übertragen.</p>
                    <p>Wird dieser Resturlaub durch den Arbeitnehmer nicht bis spätestens zum 31. März des Folgejahres in Anspruch genommen, erlischt der Anspruch zu diesem Zeitpunkt.</p>
                    <p>Wenn Urlaub wegen einer Langzeitarbeitsunfähigkeit nicht genommen werden konnte, auch nicht bis zum 31. März des Folgejahres, so verfällt der Anspruch.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'charges',
                'title'    => '§6a Urlaubsentgelt und Entgeltfortzahlung',
                'body'     => '
                    <p>Für die Berechnung der Entgeltfortzahlung im Krankheitsfall und des Urlaubsentgelts sind für jeden nach den gesetzlichen und tariflichen Bestimmungen zu vergütenden Krankheits- bzw. Urlaubstag für die Höhe des fortzuzahlenden Entgelts der durchschnittliche Arbeitsverdienst und die durchschnittliche Arbeitszeit der letzten drei abgerechneten Monate (Referenzzeitraum) vor Beginn der Arbeitsunfähigkeit bzw. des Urlaubsantritts zugrunde zu legen. Hierfür gilt:</p> 
                    <p>a) Es ist der durchschnittliche Arbeitsverdienst des Referenzzeitraums auf Grundlage der individuellen regelmäßigen Arbeitszeit zu bilden. Zum Arbeitsverdienst zählen die Entgeltbestandteile gemäß § 2 Entgelttarifvertrag iGZ sowie sonstige Zulagen und Zuschläge (ohne Mehrarbeitszuschläge) gemäß den Bestimmungen des Bundesurlaubsgesetzes.</p> 
                    <p>b) Zusätzlich finden die durchschnittlich im Referenzzeitraum erarbeiteten Zulagen und Zuschläge (ohne Mehrarbeitszuschläge) auf Grundlage der durchschnittlichen tatsächlichen Arbeitszeit Berücksichtigung, die über die individuelle regelmäßige Arbeitszeit hinausgeht.</p>
                    <p>c) Für die im Arbeitszeitkonto zu berücksichtigenden Stunden ist die im Referenzzeitraum durchschnittlich ermittelte Arbeitszeit gemäß Buchstabe b) maßgeblich (vgl. § 3.2.1.).</p> 
                    <p>Liegen im Referenzzeitraum Verdienstkürzungen aufgrund von Kurzarbeit, Krankheitstagen, für die wegen Überschreitung der 6-Wochen-Frist kein Entgeltfortzahlungsanspruch besteht, unverschuldeten Arbeitsversäumnissen oder Zeiten, in denen das Arbeitsverhältnis ruht, bleiben diese für die Berechnung außer Betracht.</p> 
                    <p>Bestehende, für den Arbeitnehmer günstigere, betriebliche Vereinbarungen bleiben unberührt. </p>
                    <p>Die in der Protokollnotiz enthaltenen Berechnungsbeispiele sind verbindliche Bestandteile des Tarifvertrages. Die Entgeltfortzahlung bei Maßnahmen der medizinischen Vorsorge und Rehabilitation richtet sich nach den Bestimmungen des Entgeltfortzahlungsgesetzes.</p>
                    <p>Die Tarifvertragsparteien einigen sich auf folgende Berechnungsbeispiele:</p>
                    <p>Beispiel 1 (auf Grundlage der individuellen regelmäßigen monatlichen Arbeitszeit):</p>
                    <p>In den letzten drei abgerechneten Monaten (65 Tage) vor dem Arbeitsausfall hat der Arbeitnehmer einen Stundenverdienst von 10,22 Euro (EG 3 bis 31.12.2013). Er hat 30 Tage à 7 Std. mit einem Branchenzuschlag von 1,53 Euro (Branchenzuschlag TV BZ M+E) gearbeitet.</p> 
                    <p>Er kehrt dann in einen zuvor ausgeübten Einsatz in der Chemieindustrie zurück und arbeitet dort an 35 Tagen à 8 Std. mit einem Branchenzuschlag von 1,02 Euro (Branchenzuschlag TV BZ Chemie).</p>
                    <p>Hieraus ergibt sich folgende Berechnung für das Urlaubsentgelt und die Entgeltfortzahlung im Krankheitsfall:</p> 
                    <p>a) 151,67 Std. x 3 Monate x 10,22 Euro = 4.650,20 Euro</p>
                    <p>(tarifliches Grundentgelt ohne Zuschläge auf Grundlage der individuellen regelmäßigen monatlichen Arbeitszeit im Referenzzeitraum)</p>
                    <p>b) 30 Tage x 7 Std. x 1,53 Euro = 321,30 Euro (Zulagen/Zuschläge auf der Grundlage der tatsächlichen Arbeitszeit) + 35 Tage x 8 Std. x 1,02 Euro = 285,60 Euro = 606,90 Euro</p>
                    <p>c) 4.650,20 Euro + 606,90 Euro = 5.257,10 Euro d) 5.257,10 Euro / 65 Tage = 80,88 Euro/Tag Für jeden Urlaubs-/Krankheitstag werden 80,88 Euro ausgezahlt.</p>
                    <p>e) (30 Tage x 7 Std. + 35 Tage x 8 Std.) / 65 Tage = 7,54 Std.</p>
                    <p>Für jeden Urlaubs-/Krankheitstag werden 7,54 Std. in der Zeiterfassung berücksichtigt.</p>
                    <p>Beispiel 2 (auf Grundlage der individuellen regelmäßigen Arbeitszeit pro Monat):
                    <p>Der Arbeitnehmer hat einen Stundenverdienst von 10,22 Euro (EG 3 bis 31.12.2013) und eine übertarifliche Zulage von 1,78 Euro, so dass er einen Gesamtverdienst pro Std. von 12 Euro hat. Er hat durchschnittlich 7,5 Std. in den letzten drei abgerechneten Monaten (65 Tage) vor dem Arbeitsausfall gearbeitet.</p> 
                    <p>Hieraus ergibt sich folgende Berechnung für das Urlaubsentgelt und die Entgeltfortzahlung im Krankheitsfall:</p>
                    <p>a) 65 Tage x 7 Std. x 10,22 Euro = 4.650,10 Euro (tarifliches Grundentgelt ohne Zuschläge auf Grundlage der regelmäßigen Arbeitszeit pro Monat im Referenzzeitraum)</p>
                    <p>b) 65 Tage x 7,5 Std. x 1,78 Euro = 867,75 Euro (Zulagen/Zuschläge auf der Grundlage der tatsächlichen Arbeitszeit)</p>
                    <p>c) 4.650,10 Euro + 867,75 Euro (Addition der Ergebnisse aus a) und b)) = 5.517,85 Euro</p>
                    <p>d) 5.517,85 Euro / 65 Tage = 84,89 Euro/Tag</p> 
                    <p>Für jeden Urlaubs-/Krankheitstag werden 84,89 Euro ausgezahlt. Für jeden Urlaubs-/Krankheitstag werden 7,5 Std. in der Zeiterfassung berücksichtigt.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'bridging_days',
                'title'    => '§7 Brückentage/Betriebsruhe',
                'body'     => '
                    <p>7.1. Um den Arbeitnehmern in Verbindung mit Feiertagen und Wochenenden (sog. Brückentage) eine längere zusammenhängende Freizeit zu gewähren, können Arbeitstage vor oder im Anschluss an Feiertage festgelegt werden, an denen nicht gearbeitet wird.</p>
                    <p>7.2. Für einen zusammenhängenden Zeitraum – von höchstens 14 Kalendertagen – kann Betriebsruhe angeordnet werden. Dazu benötigte Zeit kann vom Arbeitszeitkonto oder vom Jahresurlaub übertragen werden. Ausschließlich für diesen Zweck können auf dem Arbeitszeitkonto bis zu 50 Minusstunden angesammelt werden.</p>
                    <p>Für die Lage der Betriebsruhe sind nach Möglichkeit die Wünsche der Mitarbeiter zu berücksichtigen.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'annual_special_payment',
                'title'    => '§8 Jahressonderzahlungen',
                'body'     => '
                    <p>Nach dem sechsten Monat des ununterbrochenen Bestehens des Beschäftigungsverhältnisses (vgl. PN 5;6) hat der Arbeitnehmer Anspruch auf Jahressonderzahlungen in Form von zusätzlichem Urlaubs- und Weihnachtsgeld. Die Auszahlung des zusätzlichen Urlaubsgeldes erfolgt mit der Abrechnung für den Monat Juni eines jeden Jahres, die Auszahlung des Weihnachtsgeldes erfolgt mit der Abrechnung für den Monat November eines jeden Jahres.</p>
                    <p>Zusätzliches Urlaubs- und Weihnachtsgeld erhöhen sich mit zunehmender Dauer der Betriebszugehörigkeit, berechnet auf die Stichtage 30. Juni und 30. November.</p> 
                    <p>Das zusätzliche Urlaubs- und Weihnachtsgeld beträgt, abhängig von der Dauer des ununterbrochenen Bestehens des Arbeitsverhältnisses (vgl. PN 5;6)</p>
                    <ul>
                        <li>nach dem sechsten Monat jeweils 150 Euro brutto,</li>
                        <li>im dritten und vierten Jahr jeweils 200 Euro brutto,</li>
                        <li>ab dem fünften Jahr jeweils 300 Euro brutto.</li>
                    </ul>
                    <p>Voraussetzung für den Anspruch auf Auszahlung der Sonderzahlungen ist das Bestehen eines ungekündigten Beschäftigungsverhältnisses zum Auszahlungszeitpunkt.</p>
                    <p>Teilzeitbeschäftigte erhalten die Sonderzahlungen anteilig entsprechend der vereinbarten regelmäßigen monatlichen Arbeitszeit.</p>
                    <p>Arbeitnehmer, die bis zum 31. März des Folgejahres aus dem Arbeitgeberbetrieb ausscheiden, haben das Weihnachtsgeld zurückzuzahlen. Dies gilt nicht im Fall einer betriebsbedingten Kündigung durch den Arbeitgeber.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'conciliation_board',
                'title'    => '§9 Tarifliche Schlichtungsstelle',
                'body'     => '
                    <p>9.1. Bei Meinungsverschiedenheiten zwischen Arbeitgeber und Arbeitnehmer über die Durchführung und Anwendung dieses Tarifvertrages sind die Tarifvertragsparteien hinzuzuziehen. Der streitige Sachverhalt ist schriftlich mitzuteilen. Kann die Meinungsverschiedenheit auch mit Hilfe der Tarifvertragsparteien nicht innerhalb einer Frist von 6 Wochen vom Zeitpunkt der Mitteilung an beigelegt werden, steht der Rechtsweg offen.</p> 
                    <p>9.2. Bei Meinungsverschiedenheiten zwischen Arbeitgeber und Arbeitnehmer über die Auslegung von Bestimmungen dieses Tarifvertrages gelten die obigen Vorschriften entsprechend. Sind die Tarifvertragsparteien übereinstimmend der Auffassung, dass die Meinungsverschiedenheit grundsätzliche Bedeutung hat oder kann darüber keine Übereinstimmung erzielt werden, so entscheidet das Schiedsgericht über die Meinungsverschiedenheit unter Ausschluss der Arbeitsgerichtsbarkeit. Im anderen Fall steht der Rechtsweg offen.</p>
                    <p>Das Schiedsgericht setzt sich paritätisch aus je zwei, höchstens je drei Beisitzern zusammen. Die Arbeitgeberbeisitzer werden von dem iGZ, die Arbeitnehmerbeisitzer von der DGB-Tarifgemeinschaft von Fall zu Fall benannt.</p> 
                    <p>9.3. Das Schiedsgericht tritt innerhalb einer Frist von einem Monat ab der Feststellung gemäß § 9.2 Satz 2 zusammen.</p> 
                    <p>Kommt eine Mehrheitsentscheidung des Schiedsgerichts nicht zustande, so ist ein unparteiischer Vorsitzender hinzuzuziehen.</p> 
                    <p>Nach der Benennung des Vorsitzenden tritt das Schiedsgericht spätestens innerhalb einer Frist von einem Monat zusammen.</p> 
                    <p>Die Entscheidungen des Schiedsgerichts über die Auslegung dieses Tarifvertrages sind in Rechtsstreitigkeiten zwischen den tarifgebundenen Parteien bindend.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'limitation_period',
                'title'    => '§10 Ausschlussfrist',
                'body'     => '
                    <p>Ansprüche aus dem Arbeitsverhältnis verfallen, wenn sie nicht innerhalb einer Ausschlussfrist von drei Monaten nach Fälligkeit gegenüber der anderen Vertragspartei schriftlich geltend gemacht werden.</p> 
                    <p>Lehnt die Gegenpartei die Ansprüche schriftlich ab, sind die Ansprüche innerhalb einer weiteren Ausschlussfrist von drei Monaten ab Zugang der schriftlichen Ablehnung gerichtlich geltend zu machen.</p> 
                    <p>Ansprüche, die nicht innerhalb dieser Fristen geltend gemacht werden, sind ausgeschlossen.</p> 
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'due_date_charges',
                'title'    => '§11 Fälligkeit von Entgeltansprüchen',
                'body'     => '
                    <p>Die Arbeitnehmer erhalten ein Monatsentgelt auf der Basis der individuellen regelmäßigen monatlichen Arbeitszeit oder der regelmäßigen Arbeitszeit pro Monat, das spätestens bis zum 15. Bankarbeitstag des auf den Abrechnungsmonat folgenden Monats fällig wird.</p> 
                    <p>Auf Verlangen des Arbeitnehmers wird mit rechtzeitiger Ankündigung am Ende eines jeweiligen Abrechnungsmonats ein Abschlag von bis zu 80 Prozent des zu erwartenden Netto-Einkommens ausgezahlt. Bereits gezahlte Abschläge werden angerechnet. Sofern das Beschäftigungsverhältnis nach dem 20. des betreffenden Abrechnungsmonats beginnt sowie im Austrittsmonat besteht kein Anspruch auf eine Abschlagszahlung. Diese Abschlagsregelung findet Anwendung ab dem 01. Juli 2014.</p> 
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'strike_clause',
                'title'    => '§12 Streikklausel',
                'body'     => '
                    <p>
                        Arbeitnehmer werden im Umfang eines Streikaufrufs einer Mitgliedsgewerkschaft der DGB Tarifgemeinschaft Zeitarbeit nicht in Betrieben oder Betriebsteilen eingesetzt, die ordnungsgemäß bestreikt werden. 
                        Dies gilt auch für Arbeitnehmer, die bereits vor Beginn der Arbeitskampfmaßnahme in dem Betrieb eingesetzt wurden. Hiervon können die Parteien des Arbeitskampfes im Einzelfall abweichende Vereinbarungen treffen (z.B. Notdienstvereinbarungen). 
                        Die Regelung des § 11 Abs. 5 AÜG bleibt unberührt.
                     </p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'inception_termination',
                'title'    => '§13 Inkrafttreten und Kündigung',
                'body'     => '
                    <p>Dieser Vertrag tritt am 01. Januar 2004 für alle tarifgebundenen Mitglieder der Vertragsparteien in Kraft. Die Änderungen aus dem Verhandlungsergebnis vom 17. September 2013 treten am 01. November 2013 für alle tarifgebundenen Mitglieder der Vertragsparteien in Kraft.</p> 
                    <p>Dieser Vertrag kann unter Einhaltung einer Frist von sechs Monaten zum Monatsende, erstmals jedoch zum 31. Dezember 2016, gekündigt werden.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'severability_clause',
                'title'    => '§14 Salvatorische Klausel',
                'body'     => '
                    <p>Sollten einzelne Bestimmungen dieses Vertrages, gleich aus welchem Grund, unwirksam sein oder werden, so soll hierdurch die Gültigkeit der übrigen Bestimmungen des Vertrages nicht berührt werden. Anstelle der unwirksamen Bestimmung soll jene angemessene Bestimmung treten, die dem am nächsten kommt, was die Parteien nach Sinn und Zweck des Vertrages gewollt haben.</p>
                '
            ],
            [
                'type'     => 'igz',
                'sub_type' => 'Manteltarifvertrag',
                'section'  => 'notes',
                'title'    => 'Protokollnotizen',
                'body'     => '
                    <p>1. Der Tarifvertrag entfaltet keine Bindung für Fördermitglieder des iGZ.</p>
                    <p>2. Der Begriff Beschäftigungsverhältnis ist gleichzusetzen mit dem Begriff des Arbeitsverhältnisses.</p>
                    <p>3. Im gegenseitigen Einvernehmen können Ergänzungen jederzeit vorgenommen werden.</p>
                    <p>4. Mit den Regelungen nach § 3.2.3, § 6 und § 7 wird das Mitbestimmungsrecht des Betriebsrats nicht eingeschränkt.</p>
                    <p>5.Übergangsregelung aufgrund der Neueinführung dieses Tarifvertrages: Die Berechnung des ununterbrochenen Bestehens des Beschäftigungsverhältnisses erfolgt ab Stichtag 01. Januar 2002.</p>
                    <p>6. Bei der Berechnung der Dauer des ununterbrochenen Bestehens des Arbeitsverhältnisses werden Zeiten, in denen das Arbeitsverhältnis ruht, nicht mitgerechnet. Ausgenommen sind arbeitsbedingte Erkrankungen und Arbeitsunfälle bis zu einem Zeitraum von 12 Monaten nach Ablauf der</p>
                    <p>Entgeltfortzahlung. Die Jahressonderzahlungen gemäß § 8 werden auch bei ruhendem Arbeitsverhältnis anteilig gezahlt für die Zeiten, in denen ein sozialversicherungspflichtiges Arbeitsentgelt erzielt wurde. Satz 2 gilt dementsprechend.</p>
                    <p>7. Die Zuschläge für Arbeit an Sonn- und Feiertagen, soweit diese zur Regelarbeitszeit zählen, richten sich nach der Zuschlagsregelung im Entleihbetrieb, siehe auch § 3.1.4.</p>
                    <p>8. Auf Wunsch des Arbeitnehmers kann mit Zustimmung des Arbeitgebers eine individuelle Regelung über die Auszahlung von Arbeitszeitguthaben bis höchstens 20 Stunden pro Monat vereinbart werden.</p>
                '
            ]
        ]);
    }
}