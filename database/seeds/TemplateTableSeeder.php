<?php

use Illuminate\Database\Seeder;

class TemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('templates')->insert([
            [
                'type'  => 'basic',
                'name'  => 'termination',
                'title' => 'Kündigung',
                'text'  => '
                    <p><strong>Betreff:</strong> Ordentliche Kündigung des Arbeitsverhältnisses</p>

                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME} ,</p>
            
                    <p>Hiermit kündigen wir Ihnen den am {DATE_OF_CONTRACT} abgeschlossenen Arbeitsvertrag. Vorsorglich sprechen wir auf diesem Wege zusätzlich eine ordentliche Kündigung zum {NOTICE_TO} aus.</p>
            
                    <p>Gemäß § 6.6 des Arbeitsvertrages sind Sie verpflichtet, etwaige Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene Bereicherung zurückzuzahlen. Bitte informieren Sie uns in diesem Falle, bis wann bzw. wie Sie den ausstehenden Betrag zurückzahlen werden. Sollten wir diesbezüglich nichts von Ihnen hören, werden wir weitere rechtliche Schritte gegen Sie einleiten.</p>
            
                    <p>Mit freundlichen Grüßen</p>
            
                    <p>GF.: {SIGNATURE}</p>
                '
            ],
            [
                'type'  => 'basic',
                'name'  => 'termination_without_notice',
                'title' => 'Fristlose Kündigung',
                'text'  => '
                    <p><strong>Betreff:</strong> Fristlose Kündigung des Arbeitsverhältnisses</p>

                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME} ,</p>
            
                    <p>Hiermit kündigen wir Ihnen den am {DATE_OF_CONTRACT} abgeschlossenen Arbeitsvertrag fristlos.</p>
            
                    <p>Gemäß § 6.6 des Arbeitsvertrages sind Sie verpflichtet, etwaige Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene Bereicherung zurückzuzahlen. Bitte informieren Sie uns in diesem Falle, bis wann bzw. wie Sie den ausstehenden Betrag zurückzahlen werden. Sollten wir diesbezüglich nichts von Ihnen hören, werden wir weitere rechtliche Schritte gegen Sie einleiten.</p>
            
                    <p>Mit freundlichen Grüßen</p>
            
                    <p>GF.: {SIGNATURE}</p>
                '
            ],
            [
                'type'  => 'basic',
                'name'  => 'termination_within_probation',
                'title' => 'Kündigung in der Probezeit',
                'text'  => '
                    <p><strong>Betreff:</strong> Kündigung innerhalb  der Probezeit</p>

                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME} ,</p>
                    
                    <p>Hiermit kündigen wir Ihnen den am {DATE_OF_CONTRACT} abgeschlossenen Arbeitsvertrag fristlos.</p>
                    
                    <p>Vorsorglich sprechen wir auf diesem Wege zusätzlich eine Kündigung in der Probezeit zum {NOTICE_TO} aus.</p>
                        
                    <p>Gemäß § 6.6 des Arbeitsvertrages sind Sie verpflichtet, etwaige Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene Bereicherung zurückzuzahlen. Bitte informieren Sie uns in diesem Falle, bis wann bzw. wie Sie den ausstehenden Betrag zurückzahlen werden. Sollten wir diesbezüglich nichts von Ihnen hören, werden wir weitere rechtliche Schritte gegen Sie einleiten.</p>
            
                    <p>Wir wünschen Ihnen für Ihren weiteren privaten und beruflichen Lebensweg alles Gute.</p>
            
                    <p>Mit freundlichen Grüßen</p>
            
                    <p>GF.: {SIGNATURE}</p>
                '
            ],
            [
                'type'  => 'contract',
                'name'  => 'contract_temporary',
                'title' => 'Vertrag - Geringfügige Beschäftigung',
                'text'  => '
                    <div style="text-align: center;"><h2>Arbeitsvertrag für eine geringfügige Beschäftigung</h2></div>
            
                    <div style="text-align: center;">
                        Zwischen <br><br>
            
                        <strong>Servite GmbH</strong><br>
                        <strong>Hohenzollernring 57</strong><br>
                        <strong>50674 Köln</strong><br><br>
            
                        (im folgenden Arbeitgeber genannt)<br>
            
                        <br>
            
                        und <br><br>
                    </div>
            
                    <div style="text-align: center;">
                        <strong>{LAST_NAME}, {FIRST_NAME}</strong><br>
                        <strong>{STREET}, {POSTAL_CODE} {CITY}</strong><br>
                        <strong>{MOBILE}</strong><br>
                        <strong>{EMAIL}</strong><br><br>
            
                        (im folgenden Mitarbeiter genannt)<br>
                    </div>
            
                    <br>
            
                    <div class="center">§ 1 Erlaubnis</div>
                    <p>
                        Der Arbeitgeber überlässt als Verleiher Dritten (Entleihern) Arbeitnehmer (Leiharbeitnehmer) im Rahmen
                        ihrer wirtschaftlichen Tätigkeit zur Arbeitsleistung . Der Arbeitnehmer wird an wechselnden Einsatzstellen in
                        Kundenbetrieben und bei wechselnden Kundenbetrieben eingesetzt.
                        Die entsprechende Erlaubnis nach § 1 des Gesetzes zur Regelung der Arbeitnehmerüberlassung
                        (Arbeitnehmerüberlassungsgesetz - AÜG) wurde dem Arbeitgeber am 14.01.2005 von der Bundesagentur
                        für Arbeit in Düsseldorf erteilt.
                    </p>
            
                    <div class="center">§ 2 Beginn und Inhalt des Arbeitsverhältnisses</div>
                    <p>
                        2.1 Der Arbeitnehmer ist im Rahmen dieses Vertrages bei dem Arbeitgeber geringfügig gemäß §8 Abs. 1 Nr. 1 SGB IV angestellt. Die Überlassung an den
                        Entleiher erfolgt vorübergehend. Eine Höchstüberlassungsdauer besteht dabei nicht.
                    </p>
                    <p>
                        2.2 Das Arbeitsverhältnis beginnt am {ENTRY_DATE} und gilt auf unbestimmte Zeit geschlossen.
                    </p>
                    <p>
                        2.3 Bei unentschuldigtem Fehlen am ersten Arbeitstag gilt dieser Vertrag als nicht zustande gekommen. In
                        diesem Fall haftet der Arbeitnehmer für einen nachweislich dadurch entstandenen Schaden.
                    </p>
            
                    <div class="center">§ 3 Probezeit und Beendigung des Arbeitsverhältnisses</div>
                    <p>
                        3.1 Es ist eine Probezeit von 6 Monaten vereinbart. Entsprechend des Manteltarifvertrages des
                        Interessenverbandes Deutscher Zeitarbeitsunternehmen e.V., § 2.2, kann während der ersten vier Wochen
                        des Arbeitsverhältnisses mit einer Kündigungsfrist von zwei Arbeitstagen gekündigt werden. Von der fünf ten
                        Woche bis zum Ablauf des zweiten Monats beträgt die Kündigungsfrist eine Woche, vom dritten bis zum
                        sechsten Monat zwei Wochen. Nach Beendigung der Probe zeit gelten die gesetzlichen Kündigungsfristen
                        entsprechend § 622 BGB.
                    </p>
            
                    <p>
                        3.2 Das Recht zur außerordentlichen Kündigung bleibt hiervon unberührt.
                    </p>
            
                    <p>
                        3.3 Die Kündigung bedarf der Schriftform.
                    </p>
            
                    <div class="center">§ 4 Tätigkeiten und Pflichten des Arbeitnehmers</div>
                    <p>
                        4.1 Der Arbeitnehmer wird entsprechend der Tätigkeit im Einsatzbetrieb als Servicemitarbeiter
                        (Servicehilfskraft) eingestellt.
                    </p>
                    <p>
                        4.2 Diese Tätigkeit umfasst folgende Aufgaben (nicht abschließend): Servieren von Speisen und Getränken,
                        Vorbereiten der Serviceperioden, allgemeine Aufräum - und Reinigungsarbeiten.
                    </p>
                    <p>
                        4.3 Der Arbeitnehmer wird an verschiedenen Einsatzort en beschäftigt. Der Arbeitgeber kann den
                        Arbeitnehmer jederzeit von seinem Einsatzort abberu fen und anderweitig einsetzen. Während des Einsatzes
                        beim Kunden des Arbeitgebers unterliegt der Arbeitn ehmer dessen Weisungsrecht im Rahmen des
                        Vertrages. Änderungen der Einsatzdauer, Arbeitszeit , Art der Tätigkeit und Vergütung können nur zwische n
                        dem Arbeitnehmer und dem Arbeitgeber vereinbart werden.
                    </p>
            
                    <div class="center">§ 5 Sonstige Pflichten des Arbeitnehmers</div>
                    <p>
                        5.1 Der Arbeitnehmer verpflichtet sich, sämtliche notwendigen Einstellungsunterlagen innerhalb von zwei
                        Wochen nach Abschluss des Arbeitsvertrages vorzulegen.
                    </p>
                    <p>
                        5.2 Die Einstellung erfolgt unter der Voraussetzung fachlicher, persönlicher und gesundheitlicher Eignung.
                        Der Arbeitgeber ist berechtigt, hierfür notwendige Nachweise, insbesondere ein Führungs- und
                        Gesundheitszeugnis vom Arbeitnehmer zu fordern. Sofern entsprechende Nachweise erst nach
                        Arbeitsaufnahme vorgelegt werden können und dadurch Gründe bekannt werden, die dem Abschluss des
                        Arbeitsvertrages entgegenstehen, gilt der Vertrag als von Anfang an nicht geschlossen. Zur Abwicklung
                        gelten die Grundsätze des fehlerhaften Arbeitsvertrages.
                    </p>
                    <p>
                        5.3 Die bei einem Kunden geleisteten Arbeitsstunden (Dienstbeginn, Dienstende, Pausen) bestätigt der
                        Arbeitnehmer beim Kunden vor Ort mit seiner Unterschrift in der jeweiligen Anwesenheitsliste.
                    </p>
                    <p>
                        5.4 Der Arbeitnehmer verpflichtet sich, über alle Betriebs- und Geschäftsgeheimnisse, sowohl während der
                        Dauer des Arbeitsverhältnisses als auch nach seiner Beendigung Stillschweigen zu bewahren. Die
                        Geheimhaltungspflicht erstreckt sich nicht auf solche Kenntnisse, die jedermann zugänglich sind oder d eren
                        Weitergabe für den Arbeitgeber ersichtlich ohne Nachteile für ist. Im Zweifelsfalle sind jedoch technische,
                        kaufmännische und persönliche Vorgänge und Verhältnisse, die dem Arbeitnehmer im Zusammenhang mit
                        seiner Tätigkeit bekannt werden, als Unternehmensgehe imnisse zu behandeln. In solchen Fällen ist der
                        Arbeitnehmer vor der Offenlegung gegenüber Dritten v erpflichtet, eine Weisung der Geschäftsleitung
                        einzuholen, ob eine bestimmte Tatsache vertraulich zu behandeln ist oder nicht. Die Schweigepflicht erst
                        reckt sich auch auf die Entleiher, bei denen der Arbeitnehmer eingesetzt ist.
                    </p>
                    <p>
                        5.5 Für jeden Verstoß gegen die in § 5.4 vereinbarte Verschwiegenheitserklärung ist eine Vertragsstrafe in
                        Höhe eines Bruttomonatsgehaltes vereinbart. Dem Arbei tnehmer bleibt nachzuweisen, dass der Arbeitgeber
                        durch die Vertragsverletzung einen geringeren Schaden erlitten hat.
                    </p>
            
                    <div class="center">§ 6 Arbeitszeit</div>
                    <p>
                        6.1 Die individuelle, regelmäßige monatliche Arbeitszeit beträgt {CONTRACTUAL_WORKING_HOURS} Stunden gemäß § 12 Teilzeit-
                        und Befristungsgesetz. Sollte der Arbeitnehmer nicht für die genannte Dauer der vereinbarten Arbeitszeit
                        verliehen werden können, wird für die nicht geleisteten Stunden der vereinbarte Tariflohn gezahlt. Beträgt
                        die Arbeitszeit des Arbeitnehmers aus von ihm zu vertretenden Gründen weniger als die vereinbarte
                        Stundenzahl, entfällt für diese Zeiträume der Entgeltanspruch.
                    </p>
                    <p>
                        6.2 Der Umfang der wöchentlichen und täglichen Arbeitsleistung des Arbeitnehmers richtet sich nach dem
                        jeweiligen Arbeitsanfall. Die Arbeitsleistung kann vom Arbeitgeber individuell abgerufen werden. Zwischen
                        dem Abruf der Arbeitsleistung und dem Arbeitsantritt müssen mindestens vier Tage liegen.
                    </p>
                    <p>
                        6.3 Es ist die Wege-Zeit zu vergüten, die die Dauer von 2,50 Stunden für die einfache Wegstrecke von der
                        Wohnung zu der Tätigkeitsstätte auf dem zeitlich günstigsten Weg überschreitet, sofern er diese Wege-Zeit
                        tatsächlich aufgewendet hat.
                    </p>
                    <p>
                        6.4 Der Arbeitgeber richtet für den Arbeitnehmer gemäß § 3.2 Manteltarifvertrag iGZ ein Arbeitszeitkonto mit
                        den dort aufgeführten Abwicklungsmodalitäten ein.
                    </p>
            
                    <div class="center">§ 6 Arbeitszeit</div>
                    <p>
                        Der Arbeitnehmer verpflichtet sich gemäß § 2a Schwarzarbeitsbekämpfungsgesetz seinen
                        Personalausweis oder Pass oder Pass- oder Ausweisersatz sowie die Papiere der Aufenthalts- und
                        Arbeitserlaubnis stets mitzuführen und bei Kontrollen den Behörden auf Verlangen vorzulegen.
                    </p>
            
                    <div class="center">§ 8 Vergütung und Fälligkeit</div>
                    <p>
                        8.1 Der Arbeitnehmer wird im Rahmen einer geringfügigen Beschäftigung gemäß § 8 Abs. 1 Nr. 1 SGB IV eingesetzt. 
                        Der Arbeitnehmer kann sich jedoch durch schriftlichen Antrag beim Arbeitgeber von der Rentenversicherungspflicht befreien lassen. 
                        In diesem Fall gilt die Befreiung von der Rentenversicherungspflicht für die gesamte Dauer des Beschäftigungsverhältnisses.
                    </p>
                    <p>
                        8.2 Gemäß den in § 2 Absatz 1 EGRTV festgelegten Tätigkeitsbezeichnungen wird der Arbeitnehmer in die
                        Entgeltgruppe 1 des § 3 EGRTV eingruppiert. Der Arbeitnehmer erhält {WAGE} €/Std.
                        - ein tarifliches Entgelt, dessen Höhe sich nach den Bestimmungen des § 2 EGRTV i. V. m. §§ 4, 5 EGRTV
                        bemisst.
                        - eine übertarifliche Zulage pro geleisteter Arbeitsstunde in Höhe von {BONUS} €/Std.
                        Der Bruttostundenlohn beträgt {GROSS} €/Std.
                    </p>
                    <p>
                        8.3 Die Vergütung ist jeweils zum 15. Bankarbeitstag des Folgemonats auf ein vom Mitarbeiter
                        anzugebendes Konto zu überweisen. Soweit der Arbeitnehmer seiner Verpflichtung nach § 4.3 nicht oder
                        nicht rechtzeitig nachkommt, kann sich die Abrechnung und die Auszahlung verzögern. Diese Verzögerung
                        geht nicht zu Lasten des Arbeitgebers.
                    </p>
                    <p>
                        8.4 Die Höhe etwaiger Zuschläge, die in Abhängigkeit von der Dauer oder der Lage der Arbeitszeit geleistet
                        werden, richtet sich nach der Zuschlagsreglung des Entleihers und ist im Tarifvertrag § 4 Ziffer 4.5.4
                        geregelt.
                    </p>
                    <p>
                        8.5 Der Mitarbeiter verpflichtet sich, Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene
                        Bereicherung zurückzuzahlen.
                    </p>
                    <p>
                        8.6 Der Mitarbeiter darf seine Vergütungsansprüche weder verpfänden noch abtreten. Der Arbeitgeber
                        behält sich vor, nachträglich vertragswidrig vorgenommene Abtretungen oder Verpfändungen zu
                        genehmigen. Die Kosten, die dem Arbeitgeber durch die Bearbeitung von Verpfändungen und Abtretungen
                        der Vergütungsansprüche des Mitarbeiters entstehen, trägt der Mitarbeiter. Diese Kosten werden
                        pauschaliert mit 8,00 € pro Pfändung, Abtretung und Verpfändung sowie ggf. zusätzlich 4,- € für jedes
                        Schreiben sowie 1 € pro Überweisung. Bei Nachweis höherer tatsächlicher Kosten ist der Arbeitgeber
                        berechtigt, diese in Ansatz zu bringen.
                    </p>
            
            
                    <div class="center">§ 9 Urlaub</div>
                    <p>
                        9.1 Je Kalenderjahr hat der Arbeitnehmer Anspruch auf bezahlten Erholungsurlaub, der ggf. anteilig
                        gewährt wird. Die Anzahl der Urlaubstage richtet sich nach § 6 des Manteltarifvertrages. Der Zeitpunkt des
                        Urlaubsantrittes erfolgt im Einvernehmen mit dem Arbeitgeber.
                    </p>
                    <p>
                        9.2 Das Urlaubsentgelt ergibt sich aus den tariflichen Vereinbarungen und errechnet sich aus dem
                        Tarifentgelt auf der Basis der regelmäßigen monatlichen Arbeitszeit, wobei Zuschläge für die besondere
                        Lage der Arbeitszeit bei der Berechnung zu berücksichtigen sind.
                    </p>
                    <p>
                        9.3 Nach dem 6. Monat des ununterbrochenen Bestehens des Beschäftigungsverhältnisses hat der
                        Arbeitnehmer Anspruch auf Jahressonderzahlungen in Form von zusätzlichem Urlaubs- und
                        Weihnachtsgeld. Die zu gewährende Jahressonderzahlung richtet sich nach § 8 MTV.
                    </p>
            
                    <div class="center">§ 10 Arbeitsverhinderung</div>
                    <p>
                        10.1 Bei krankheitsbedingter Arbeitsunfähigkeit ist der Arbeitnehmer verpflichtet, den Arbeitgeber
                        unverzüglich zu unterrichten. Dies gilt auch bei sonstiger Arbeitsverhinderung. Darüber hinaus hat der
                        Mitarbeiter bei krankheitsbedingter Arbeitsverhinderung spätestens nach Ablauf des 3. Kalendertages nach
                        Beginn der Arbeitsunfähigkeit dem Arbeitgeber eine ärztliche Arbeitsunfähigkeitsbescheinigung
                        einzureichen. Dauert die Arbeitsunfähigkeit länger als in der Bescheinigung angegeben an, so ist der
                        Arbeitnehmer verpflichtet, eine neue ärztliche Arbeitsunfähigkeitsbescheinigung einzureichen. Gleichzeitig
                        hat der den Arbeitgeber darüber unverzüglich zu unterrichten.
                    </p>
            
                    <p>
                        10.2 Die Pflicht, den Arbeitgeber unverzüglich über Arbeitsverhinderung und die Gründe zu unterrichten, gilt
                        auch bei sonstiger Arbeitsverhinderung.
                    </p>
            
                    <div class="center">§ 11 Nebentätigkeiten</div>
                    <p>
                        11.1 Sofern er sich bei der vorliegenden Tätigkeit um eine Nebentätigkeit handelt, hat der Arbeitnehmer den
                        Arbeitgeber bei Vertragsschluss über die Haupttätigkeit zu unterrichten.
                    </p>
                    <p>
                        11.2 Jede Nebentätigkeit, gleichgültig ob sie entgeltlich oder unentgeltlich ausgeübt wird, bedarf der
                        vorherigen Zustimmung des Arbeitgebers. Die Zustimmung ist zu erteilen, wenn die Nebentätigkeit die
                        Wahrnehmung der dienstlichen Aufgaben zeitlich nicht oder allenfalls unwesentlich behindert und sonstige
                        berechtigte Interessen des Arbeitgebers nicht beeinträchtigt werden.
                    </p>
                    <p>
                        11.3 Der Arbeitgeber hat die Entscheidung über den Antrag des Arbeitnehmers auf Zustimmung zur
                        Nebentätigkeit innerhalb von vier Wochen nach Eingang des Antrags zu treffen. Wird innerhalb dieser Frist
                        eine Entscheidung nicht gefällt, gilt die Zustimmung als erteilt.
                    </p>
            
                    <div class="center">§ 12 Unfallverhütung/Arbeitsschutz</div>
                    <p>
                        Der Arbeitnehmer erklärt, dass er die für den jeweiligen Arbeitsplatz geltenden Unfallverhütungsvorschriften
                        beachten und verfolgen wird. Der Arbeitgeber wird ihm die jeweils geltenden Unfallverhütungsvorschriften
                        vor jedem Einsatz zur Kenntnis geben und dafür Sorge tragen, dass er vor dem ersten Tätigwerden am
                        Arbeitsplatz entsprechend eingewiesen wird. Der Arbeitgeber wird dafür Sorge tragen, dass der
                        Arbeitnehmer die für die jeweilige Arbeit vorgeschriebene, erforderliche Schutzausrüstung kostenlos erhält.
                        Bei Betriebs- und Wegeunfällen wird der Arbeitnehmer beim Arbeitgeber unverzüglich eine Unfallmeldung
                        erstatten.
                    </p>
            
                    <div class="center">§ 14 Vertragsstrafe</div>
                    <div>14.1 Der Arbeitnehmer hat eine Vertragsstrafe an den Arbeitgeber zu zahlen, wenn
                        <ul>
                            <li>er die Arbeit im laufenden Arbeitsverhältnis rechtswidrig nicht oder wiederholt verspätet
                                aufnimmt,
                            </li>
                            <li>er das Arbeitsverhältnis rechtswidrig ohne Einhaltung der maßgeblichen Kündigungsfrist auslöst,</li>
                            <li>er vorrübergehend die Arbeit rechtswidrig verweigert oder Arbeitsbummelei begeht,</li>
                            <li>er wiederholt Tätigkeitsnachweise oder Arbeitsunfähigkeitsbescheinigungen nicht rechtzeitig
                                einreicht,
                            </li>
                            <li>er Straftaten oder Ordnungswidrigkeiten zum Nachteil des Arbeitgebers, des Entleihers oder zum
                                Nachteil
                                von anderen Arbeitnehmern begeht,
                            </li>
                            <li>er eigenmächtig seinen Urlaub antritt,</li>
                            <li>er mit Krankheit droht,</li>
                            <li>er wiederholt Nachweis- oder Meldepflichten schuldhaft nicht nachkommt oder unentschuldigt fehlt
                                oder
                                schuldhaft nicht erreichbar ist,
                            </li>
                            <li>er unter Alkohol- oder Drogeneinfluss am Arbeitsplatz angetroffen wird,</li>
                            <li>er einer nicht genehmigungsfähigen Nebentätigkeit nachgeht,</li>
                            <li>er schuldhaft eine unverwertbare Arbeitsleistung erbringt.</li>
                        </ul>
                    </div>
                    <p>
                        14.2 Die Vertragsstrafe wird nur fällig, wenn der Arbeitnehmer grob fahrlässig oder vorsätzlich gehandelt
                        hat.
                    </p>
                    <p>
                        14.3 Als Vertragsstrafe ist für die Fälle der rechtswidrigen Auflösung des Arbeitsverhältnisses ohne
                        Einhaltung der maßgeblichen Kündigungsfrist durch den Arbeitnehmer und der Veranlassung des
                        Arbeitgebers zu einer fristlosen Kündigung wegen schwerwiegender Vertragsverstöße des Arbeitnehmers
                        eine Vertragsstrafe des ansonsten in der maßgeblichen Kündigungsfrist enthaltenen Arbeitsentgeltes
                    </p>
            
                    <div class="center">§ 15 Datenschutz</div>
                    <p>
                        Der Arbeitnehmer erklärt sein Einverständnis damit, dass seine persönlichen Daten, soweit sie dem
                        Arbeitgeber bekannt sind, in EDV-Anlagen beim Arbeitgeber oder einem Beauftragten gespeichert und
                        verarbeitet werden dürfen.
                    </p>
            
                    <div class="center">§ 16 Sonstiges</div>
                    <p>
                        16.1 Änderungen des Vertrages und Nebenabreden bedürfen zu ihrer Wirksamkeit der Schriftform.
                    </p>
                    <p>
                        16.2   Der   Arbeitnehmer   bestätigt   durch   seine   Unterschrift,   vom   Arbeitgeber   das   Merkblatt   der
                        Bundesagentur für Arbeit über den wesentlichen Inhalt des Arbeitnehmerüberlassungsgesetzes und eine
                        Kurzfassung der Unfallverhütungsvorschriften erhalten zu haben.
                    </p>
                    <p>
                        16.3   Der   bei   der   Einstellung   ausgefüllte   Personalfragebogen   ist   Bestandteil   dieses   Vertrages.   Im
                        Fragebogen gemachte, unrichtige Angaben berechtigen den Arbeitgeber zur fristlosen Kündigung.
                    </p>
                    <p>
                        16.4 Dieser Vertrag wird in 2 Ausführungen erstellt und von beiden Vertragsparteien unterschrieben. Der
                        Arbeitnehmer bestätigt, eine gleichlautende Ausfertigung erhalten zu haben.
                    </p>
                    <p>
                        16.5 Zur Aufrechterhaltung ungekürzter Ansprüche auf Arbeitslosengeld ist der Arbeitnehmer verpflichtet,
                        sich 3 Monate vor Ablauf des Vertragsverhältnisses persönlich beim Arbeitsamt arbeitssuchend zu melden.
                        Weiterhin ist er verpflichtet, aktiv nach einer Beschäftigung zu suchen.
                    </p>
                    <p>
                        16.6 Gerichtsstand ist Köln
                    </p>
                    <p>
                        16.7   Sollte   eine   Bestimmung   dieser   Vereinbarung   unwirksam   sein,   bleibt   die   Wirksamkeit   der   übrigen
                        Bestimmungen hiervon unberührt. Die Parteien verpflichten sich, die unwirksame Bestimmung durch eine -
                        dieser in Interessenslage und Bedeutung möglichst entsprechende  -  wirksame Bestimmung zu ersetzen.
                    </p>
                '
            ],
            [
                'type'  => 'contract',
                'name'  => 'contract_parttime',
                'title' => 'Vertrag - Teilzeit',
                'text'  => '
                    
                       <div class="center"><h2>Arbeitsvertrag für eine Teilzeit-Beschäftigung</h2></div>
            
                    <div style="text-align: center;">
                        Zwischen <br><br>
            
                        <strong>Servite GmbH</strong><br>
                        <strong>Hohenzollernring 57</strong><br>
                        <strong>50674 Köln</strong><br><br>
            
                        (im folgenden Arbeitgeber genannt)<br>
            
                        <br>
            
                        und <br><br>
                    </div>
            
                    <div style="text-align: center;">
                        <strong>{LAST_NAME}, {FIRST_NAME}</strong><br>
                        <strong>{STREET}, {POSTAL_CODE} {CITY}</strong><br>
                        <strong>{MOBILE}</strong><br>
                        <strong>{EMAIL}</strong><br><br>
            
                        (im folgenden Mitarbeiter genannt)<br>
                    </div>
            
                    <br>
            
                    <div class="center">§ 1 Erlaubnis</div>
                    <p>
                        Der Arbeitgeber überlässt als Verleiher Dritten (Entleihern) Arbeitnehmer (Leiharbeitnehmer) im Rahmen
                        ihrer wirtschaftlichen Tätigkeit zur Arbeitsleistung . Der Arbeitnehmer wird an wechselnden Einsatzstellen in
                        Kundenbetrieben und bei wechselnden Kundenbetrieben eingesetzt.
                        Die entsprechende Erlaubnis nach § 1 des Gesetzes zur Regelung der Arbeitnehmerüberlassung
                        (Arbeitnehmerüberlassungsgesetz - AÜG) wurde dem Arbeitgeber am 14.01.2005 von der Bundesagentur
                        für Arbeit in Düsseldorf erteilt.
                    </p>
            
                    <div class="center">§ 2 Beginn und Inhalt des Arbeitsverhältnisses</div>
                    <p>
                        2.1 Der Arbeitnehmer ist im Rahmen dieses Vertrages bei dem Arbeitgeber angestellt. Die Überlassung an den
                        Entleiher erfolgt vorübergehend. Eine Höchstüberlassungsdauer besteht dabei nicht.
                    </p>
                    <p>
                        2.2 Das Arbeitsverhältnis beginnt am {ENTRY_DATE} und gilt auf unbestimmte Zeit geschlossen.
                    </p>
                    <p>
                        2.3 Bei unentschuldigtem Fehlen am ersten Arbeitstag gilt dieser Vertrag als nicht zustande gekommen. In
                        diesem Fall haftet der Arbeitnehmer für einen nachweislich dadurch entstandenen Schaden.
                    </p>
            
                    <div class="center">§ 3 Probezeit und Beendigung des Arbeitsverhältnisses</div>
                    <p>
                        3.1 Es ist eine Probezeit von 6 Monaten vereinbart. Entsprechend des Manteltarifvertrages des
                        Interessenverbandes Deutscher Zeitarbeitsunternehmen e.V., § 2.2, kann während der ersten vier Wochen
                        des Arbeitsverhältnisses mit einer Kündigungsfrist von zwei Arbeitstagen gekündigt werden. Von der fünf ten
                        Woche bis zum Ablauf des zweiten Monats beträgt die Kündigungsfrist eine Woche, vom dritten bis zum
                        sechsten Monat zwei Wochen. Nach Beendigung der Probe zeit gelten die gesetzlichen Kündigungsfristen
                        entsprechend § 622 BGB.
                    </p>
            
                    <p>
                        3.2 Das Recht zur außerordentlichen Kündigung bleibt hiervon unberührt.
                    </p>
            
                    <p>
                        3.3 Die Kündigung bedarf der Schriftform.
                    </p>
            
                    <div class="center">§ 4 Tätigkeiten und Pflichten des Arbeitnehmers</div>
                    <p>
                        4.1 Der Arbeitnehmer wird entsprechend der Tätigkeit im Einsatzbetrieb als Servicemitarbeiter
                        (Servicehilfskraft) eingestellt.
                    </p>
                    <p>
                        4.2 Diese Tätigkeit umfasst folgende Aufgaben (nicht abschließend): Servieren von Speisen und Getränken,
                        Vorbereiten der Serviceperioden, allgemeine Aufräum - und Reinigungsarbeiten.
                    </p>
                    <p>
                        4.3 Der Arbeitnehmer wird an verschiedenen Einsatzort en beschäftigt. Der Arbeitgeber kann den
                        Arbeitnehmer jederzeit von seinem Einsatzort abberu fen und anderweitig einsetzen. Während des Einsatzes
                        beim Kunden des Arbeitgebers unterliegt der Arbeitn ehmer dessen Weisungsrecht im Rahmen des
                        Vertrages. Änderungen der Einsatzdauer, Arbeitszeit , Art der Tätigkeit und Vergütung können nur zwische n
                        dem Arbeitnehmer und dem Arbeitgeber vereinbart werden.
                    </p>
            
                    <div class="center">§ 5 Sonstige Pflichten des Arbeitnehmers</div>
                    <p>
                        5.1 Der Arbeitnehmer verpflichtet sich, sämtliche notwendigen Einstellungsunterlagen innerhalb von zwei
                        Wochen nach Abschluss des Arbeitsvertrages vorzulegen.
                    </p>
                    <p>
                        5.2 Die Einstellung erfolgt unter der Voraussetzung fachlicher, persönlicher und gesundheitlicher Eignung.
                        Der Arbeitgeber ist berechtigt, hierfür notwendige Nachweise, insbesondere ein Führungs- und
                        Gesundheitszeugnis vom Arbeitnehmer zu fordern. Sofern entsprechende Nachweise erst nach
                        Arbeitsaufnahme vorgelegt werden können und dadurch Gründe bekannt werden, die dem Abschluss des
                        Arbeitsvertrages entgegenstehen, gilt der Vertrag als von Anfang an nicht geschlossen. Zur Abwicklung
                        gelten die Grundsätze des fehlerhaften Arbeitsvertrages.
                    </p>
                    <p>
                        5.3 Die bei einem Kunden geleisteten Arbeitsstunden (Dienstbeginn, Dienstende, Pausen) bestätigt der
                        Arbeitnehmer beim Kunden vor Ort mit seiner Unterschrift in der jeweiligen Anwesenheitsliste.
                    </p>
                    <p>
                        5.4 Der Arbeitnehmer verpflichtet sich, über alle Betriebs- und Geschäftsgeheimnisse, sowohl während der
                        Dauer des Arbeitsverhältnisses als auch nach seiner Beendigung Stillschweigen zu bewahren. Die
                        Geheimhaltungspflicht erstreckt sich nicht auf solche Kenntnisse, die jedermann zugänglich sind oder d eren
                        Weitergabe für den Arbeitgeber ersichtlich ohne Nachteile für ist. Im Zweifelsfalle sind jedoch technische,
                        kaufmännische und persönliche Vorgänge und Verhältnisse, die dem Arbeitnehmer im Zusammenhang mit
                        seiner Tätigkeit bekannt werden, als Unternehmensgehe imnisse zu behandeln. In solchen Fällen ist der
                        Arbeitnehmer vor der Offenlegung gegenüber Dritten v erpflichtet, eine Weisung der Geschäftsleitung
                        einzuholen, ob eine bestimmte Tatsache vertraulich zu behandeln ist oder nicht. Die Schweigepflicht erst
                        reckt sich auch auf die Entleiher, bei denen der Arbeitnehmer eingesetzt ist.
                    </p>
                    <p>
                        5.5 Für jeden Verstoß gegen die in § 5.4 vereinbarte Verschwiegenheitserklärung ist eine Vertragsstrafe in
                        Höhe eines Bruttomonatsgehaltes vereinbart. Dem Arbei tnehmer bleibt nachzuweisen, dass der Arbeitgeber
                        durch die Vertragsverletzung einen geringeren Schaden erlitten hat.
                    </p>
            
                    <div class="center">§ 6 Arbeitszeit</div>
                    <p>
                        6.1 Die individuelle, regelmäßige monatliche Arbeitszeit beträgt {CONTRACTUAL_WORKING_HOURS} Stunden gemäß § 12 Teilzeit-
                        und Befristungsgesetz. Sollte der Arbeitnehmer nicht für die genannte Dauer der vereinbarten Arbeitszeit
                        verliehen werden können, wird für die nicht geleisteten Stunden der vereinbarte Tariflohn gezahlt. Beträgt
                        die Arbeitszeit des Arbeitnehmers aus von ihm zu vertretenden Gründen weniger als die vereinbarte
                        Stundenzahl, entfällt für diese Zeiträume der Entgeltanspruch.
                    </p>
                    <p>
                        6.2 Der Umfang der wöchentlichen und täglichen Arbeitsleistung des Arbeitnehmers richtet sich nach dem
                        jeweiligen Arbeitsanfall. Die Arbeitsleistung kann vom Arbeitgeber individuell abgerufen werden. Zwischen
                        dem Abruf der Arbeitsleistung und dem Arbeitsantritt müssen mindestens vier Tage liegen.
                    </p>
                    <p>
                        6.3 Es ist die Wege-Zeit zu vergüten, die die Dauer von 2,50 Stunden für die einfache Wegstrecke von der
                        Wohnung zu der Tätigkeitsstätte auf dem zeitlich günstigsten Weg überschreitet, sofern er diese Wege-Zeit
                        tatsächlich aufgewendet hat.
                    </p>
                    <p>
                        6.4 Der Arbeitgeber richtet für den Arbeitnehmer gemäß § 3.2 Manteltarifvertrag iGZ ein Arbeitszeitkonto mit
                        den dort aufgeführten Abwicklungsmodalitäten ein.
                    </p>
            
                    <div class="center">§ 6 Arbeitszeit</div>
                    <p>
                        Der Arbeitnehmer verpflichtet sich gemäß § 2a Schwarzarbeitsbekämpfungsgesetz seinen
                        Personalausweis oder Pass oder Pass- oder Ausweisersatz sowie die Papiere der Aufenthalts- und
                        Arbeitserlaubnis stets mitzuführen und bei Kontrollen den Behörden auf Verlangen vorzulegen.
                    </p>
            
                    <div class="center">§ 8 Vergütung und Fälligkeit</div>
                    <p>
                        8.1 Gemäß den in § 2 Absatz 1 EGRTV festgelegten Tätigkeitsbezeichnungen wird der Arbeitnehmer in die
                        Entgeltgruppe 1 des § 3 EGRTV eingruppiert.
                    </p>
                    <p>
                        8.2 Der Arbeitnehmer erhält {WAGE} €/Std.
                        - ein tarifliches Entgelt, dessen Höhe sich nach den Bestimmungen des § 2 EGRTV i. V. m. §§ 4, 5 EGRTV
                        bemisst.
                        - eine übertarifliche Zulage pro geleisteter Arbeitsstunde in Höhe von {BONUS} €/Std.
                        Der Bruttostundenlohn beträgt {GROSS} €/Std.
                    </p>
                    <p>
                        8.3 Die Vergütung ist jeweils zum 15. Bankarbeitstag des Folgemonats auf ein vom Mitarbeiter
                        anzugebendes Konto zu überweisen. Soweit der Arbeitnehmer seiner Verpflichtung nach § 4.3 nicht oder
                        nicht rechtzeitig nachkommt, kann sich die Abrechnung und die Auszahlung verzögern. Diese Verzögerung
                        geht nicht zu Lasten des Arbeitgebers.
                    </p>
                    <p>
                        8.4 Die Höhe etwaiger Zuschläge, die in Abhängigkeit von der Dauer oder der Lage der Arbeitszeit geleistet
                        werden, richtet sich nach der Zuschlagsreglung des Entleihers und ist im Tarifvertrag § 4 Ziffer 4.5.4
                        geregelt.
                    </p>
                    <p>
                        8.5 Der Mitarbeiter verpflichtet sich, Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene
                        Bereicherung zurückzuzahlen.
                    </p>
                    <p>
                        8.6 Der Mitarbeiter darf seine Vergütungsansprüche weder verpfänden noch abtreten. Der Arbeitgeber
                        behält sich vor, nachträglich vertragswidrig vorgenommene Abtretungen oder Verpfändungen zu
                        genehmigen. Die Kosten, die dem Arbeitgeber durch die Bearbeitung von Verpfändungen und Abtretungen
                        der Vergütungsansprüche des Mitarbeiters entstehen, trägt der Mitarbeiter. Diese Kosten werden
                        pauschaliert mit 8,00 € pro Pfändung, Abtretung und Verpfändung sowie ggf. zusätzlich 4,- € für jedes
                        Schreiben sowie 1 € pro Überweisung. Bei Nachweis höherer tatsächlicher Kosten ist der Arbeitgeber
                        berechtigt, diese in Ansatz zu bringen.
                    </p>
            
            
                    <div class="center">§ 9 Urlaub</div>
                    <p>
                        9.1 Je Kalenderjahr hat der Arbeitnehmer Anspruch auf bezahlten Erholungsurlaub, der ggf. anteilig
                        gewährt wird. Die Anzahl der Urlaubstage richtet sich nach § 6 des Manteltarifvertrages. Der Zeitpunkt des
                        Urlaubsantrittes erfolgt im Einvernehmen mit dem Arbeitgeber.
                    </p>
                    <p>
                        9.2 Das Urlaubsentgelt ergibt sich aus den tariflichen Vereinbarungen und errechnet sich aus dem
                        Tarifentgelt auf der Basis der regelmäßigen monatlichen Arbeitszeit, wobei Zuschläge für die besondere
                        Lage der Arbeitszeit bei der Berechnung zu berücksichtigen sind.
                    </p>
                    <p>
                        9.3 Nach dem 6. Monat des ununterbrochenen Bestehens des Beschäftigungsverhältnisses hat der
                        Arbeitnehmer Anspruch auf Jahressonderzahlungen in Form von zusätzlichem Urlaubs- und
                        Weihnachtsgeld. Die zu gewährende Jahressonderzahlung richtet sich nach § 8 MTV.
                    </p>
            
                    <div class="center">§ 10 Arbeitsverhinderung</div>
                    <p>
                        10.1 Bei krankheitsbedingter Arbeitsunfähigkeit ist der Arbeitnehmer verpflichtet, den Arbeitgeber
                        unverzüglich zu unterrichten. Dies gilt auch bei sonstiger Arbeitsverhinderung. Darüber hinaus hat der
                        Mitarbeiter bei krankheitsbedingter Arbeitsverhinderung spätestens nach Ablauf des 3. Kalendertages nach
                        Beginn der Arbeitsunfähigkeit dem Arbeitgeber eine ärztliche Arbeitsunfähigkeitsbescheinigung
                        einzureichen. Dauert die Arbeitsunfähigkeit länger als in der Bescheinigung angegeben an, so ist der
                        Arbeitnehmer verpflichtet, eine neue ärztliche Arbeitsunfähigkeitsbescheinigung einzureichen. Gleichzeitig
                        hat der den Arbeitgeber darüber unverzüglich zu unterrichten.
                    </p>
            
                    <p>
                        10.2 Die Pflicht, den Arbeitgeber unverzüglich über Arbeitsverhinderung und die Gründe zu unterrichten, gilt
                        auch bei sonstiger Arbeitsverhinderung.
                    </p>
            
                    <div class="center">§ 11 Nebentätigkeiten</div>
                    <p>
                        11.1 Sofern er sich bei der vorliegenden Tätigkeit um eine Nebentätigkeit handelt, hat der Arbeitnehmer den
                        Arbeitgeber bei Vertragsschluss über die Haupttätigkeit zu unterrichten.
                    </p>
                    <p>
                        11.2 Jede Nebentätigkeit, gleichgültig ob sie entgeltlich oder unentgeltlich ausgeübt wird, bedarf der
                        vorherigen Zustimmung des Arbeitgebers. Die Zustimmung ist zu erteilen, wenn die Nebentätigkeit die
                        Wahrnehmung der dienstlichen Aufgaben zeitlich nicht oder allenfalls unwesentlich behindert und sonstige
                        berechtigte Interessen des Arbeitgebers nicht beeinträchtigt werden.
                    </p>
                    <p>
                        11.3 Der Arbeitgeber hat die Entscheidung über den Antrag des Arbeitnehmers auf Zustimmung zur
                        Nebentätigkeit innerhalb von vier Wochen nach Eingang des Antrags zu treffen. Wird innerhalb dieser Frist
                        eine Entscheidung nicht gefällt, gilt die Zustimmung als erteilt.
                    </p>
            
                    <div class="center">§ 12 Unfallverhütung/Arbeitsschutz</div>
                    <p>
                        Der Arbeitnehmer erklärt, dass er die für den jeweiligen Arbeitsplatz geltenden Unfallverhütungsvorschriften
                        beachten und verfolgen wird. Der Arbeitgeber wird ihm die jeweils geltenden Unfallverhütungsvorschriften
                        vor jedem Einsatz zur Kenntnis geben und dafür Sorge tragen, dass er vor dem ersten Tätigwerden am
                        Arbeitsplatz entsprechend eingewiesen wird. Der Arbeitgeber wird dafür Sorge tragen, dass der
                        Arbeitnehmer die für die jeweilige Arbeit vorgeschriebene, erforderliche Schutzausrüstung kostenlos erhält.
                        Bei Betriebs- und Wegeunfällen wird der Arbeitnehmer beim Arbeitgeber unverzüglich eine Unfallmeldung
                        erstatten.
                    </p>
            
                    <div class="center">§ 14 Vertragsstrafe</div>
                    <div>14.1 Der Arbeitnehmer hat eine Vertragsstrafe an den Arbeitgeber zu zahlen, wenn
                        <ul>
                            <li>er die Arbeit im laufenden Arbeitsverhältnis rechtswidrig nicht oder wiederholt verspätet
                                aufnimmt,
                            </li>
                            <li>er das Arbeitsverhältnis rechtswidrig ohne Einhaltung der maßgeblichen Kündigungsfrist auslöst,</li>
                            <li>er vorrübergehend die Arbeit rechtswidrig verweigert oder Arbeitsbummelei begeht,</li>
                            <li>er wiederholt Tätigkeitsnachweise oder Arbeitsunfähigkeitsbescheinigungen nicht rechtzeitig
                                einreicht,
                            </li>
                            <li>er Straftaten oder Ordnungswidrigkeiten zum Nachteil des Arbeitgebers, des Entleihers oder zum
                                Nachteil
                                von anderen Arbeitnehmern begeht,
                            </li>
                            <li>er eigenmächtig seinen Urlaub antritt,</li>
                            <li>er mit Krankheit droht,</li>
                            <li>er wiederholt Nachweis- oder Meldepflichten schuldhaft nicht nachkommt oder unentschuldigt fehlt
                                oder
                                schuldhaft nicht erreichbar ist,
                            </li>
                            <li>er unter Alkohol- oder Drogeneinfluss am Arbeitsplatz angetroffen wird,</li>
                            <li>er einer nicht genehmigungsfähigen Nebentätigkeit nachgeht,</li>
                            <li>er schuldhaft eine unverwertbare Arbeitsleistung erbringt.</li>
                        </ul>
                    </div>
                    <p>
                        14.2 Die Vertragsstrafe wird nur fällig, wenn der Arbeitnehmer grob fahrlässig oder vorsätzlich gehandelt
                        hat.
                    </p>
                    <p>
                        14.3 Als Vertragsstrafe ist für die Fälle der rechtswidrigen Auflösung des Arbeitsverhältnisses ohne
                        Einhaltung der maßgeblichen Kündigungsfrist durch den Arbeitnehmer und der Veranlassung des
                        Arbeitgebers zu einer fristlosen Kündigung wegen schwerwiegender Vertragsverstöße des Arbeitnehmers
                        eine Vertragsstrafe des ansonsten in der maßgeblichen Kündigungsfrist enthaltenen Arbeitsentgeltes
                    </p>
            
                    <div class="center">§ 15 Datenschutz</div>
                    <p>
                        Der Arbeitnehmer erklärt sein Einverständnis damit, dass seine persönlichen Daten, soweit sie dem
                        Arbeitgeber bekannt sind, in EDV-Anlagen beim Arbeitgeber oder einem Beauftragten gespeichert und
                        verarbeitet werden dürfen.
                    </p>
            
                    <div class="center">§ 16 Sonstiges</div>
                    <p>
                        16.1 Änderungen des Vertrages und Nebenabreden bedürfen zu ihrer Wirksamkeit der Schriftform.
                    </p>
                    <p>
                        16.2   Der   Arbeitnehmer   bestätigt   durch   seine   Unterschrift,   vom   Arbeitgeber   das   Merkblatt   der
                        Bundesagentur für Arbeit über den wesentlichen Inhalt des Arbeitnehmerüberlassungsgesetzes und eine
                        Kurzfassung der Unfallverhütungsvorschriften erhalten zu haben.
                    </p>
                    <p>
                        16.3   Der   bei   der   Einstellung   ausgefüllte   Personalfragebogen   ist   Bestandteil   dieses   Vertrages.   Im
                        Fragebogen gemachte, unrichtige Angaben berechtigen den Arbeitgeber zur fristlosen Kündigung.
                    </p>
                    <p>
                        16.4 Dieser Vertrag wird in 2 Ausführungen erstellt und von beiden Vertragsparteien unterschrieben. Der
                        Arbeitnehmer bestätigt, eine gleichlautende Ausfertigung erhalten zu haben.
                    </p>
                    <p>
                        16.5 Zur Aufrechterhaltung ungekürzter Ansprüche auf Arbeitslosengeld ist der Arbeitnehmer verpflichtet,
                        sich 3 Monate vor Ablauf des Vertragsverhältnisses persönlich beim Arbeitsamt arbeitssuchend zu melden.
                        Weiterhin ist er verpflichtet, aktiv nach einer Beschäftigung zu suchen.
                    </p>
                    <p>
                        16.6 Gerichtsstand ist Köln
                    </p>
                    <p>
                        16.7   Sollte   eine   Bestimmung   dieser   Vereinbarung   unwirksam   sein,   bleibt   die   Wirksamkeit   der   übrigen
                        Bestimmungen hiervon unberührt. Die Parteien verpflichten sich, die unwirksame Bestimmung durch eine -
                        dieser in Interessenslage und Bedeutung möglichst entsprechende  -  wirksame Bestimmung zu ersetzen.
                    </p>
                '
            ],
            [
                'type'  => 'basic',
                'name'  => 'warning',
                'title' => 'Abmahnung',
                'text'  => '
                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME},</p>
                    <p>
                        zu unserem Bedauern mussten wir feststellen, dass Sie Ihre arbeitsvertraglichen Pflichten in schwerwiegender Weise verletzt haben. Ihr im Folgenden geschildertes Verhalten veranlasst uns,
                        Sie auf die ordnungsgemäße Erfüllung Ihrer arbeitsvertraglichen Pflichten hinzuweisen.
                    </p>
                    <p>
                        Wir sind am {DATE_OF_NOTICE} darüber informiert worden, dass Sie sich entgegen der arbeitsvertraglichen Verpflichtungen verhalten haben.
                        Der Arbeitnehmer hat eine Vertragsstrafe §14.1 an den Arbeitgeber zu zahlen, wenn
                    </p>
                    
                    {REASON}
                    
                    <p>Tag des Verstoßes:</p>
                    
                    <br>
            
                    <p>am {DATE_OF_VIOLATION} - Vertragsstrafe beträgt: {AMOUNT} Euro</p>
            
            
                    <p>Hinweis: {NOTE}</p>
            
                    <p>
                        Für alle übrigen in § 14.1 genannten Fälle ist ein Bruttotagesentgelt für jeden Tag der Zuwiderhandlung verwirkt. Sie haben damit Ihre Pflichten aus dem Arbeitsvertrag verletzt. Wir erwarten, dass Sie dieses Verhalten  in dem oben geschilderten Umfang einstellen, weil Sie andernfalls gegen das Arbeitsvertrag verstoßen.
                        Wir fordern Sie deshalb ausdrücklich auf, das oben geschilderte Verhalten zukünftig zu unterlassen und Ihre Pflichten aus dem Arbeitsvertrag zu erfüllen.
                        Im Falle der Wiederholung des in dieser Abmahnung gerügten Verhaltens behalten wir uns vor, Ihr Arbeitsverhältnis ordentlich, gegebenenfalls auch außerordentlich fristlos zu kündigen.
                    </p>
            
                    <p>
                        Eine Durchschrift dieser Abmahnung legen wir in der Personalakte ab.
                    </p>
                '
            ],
            [
                'type'  => 'basic',
                'name'  => 'reminder',
                'title' => 'Erinnerung',
                'text' => '
                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME},</p>
                    <p>
                        zu unserem Bedauern mussten wir feststellen, dass Sie Ihre arbeitsvertraglichen Pflichten in schwerwiegender Weise verletzt haben. Ihr im Folgenden geschildertes Verhalten veranlasst uns,
                        Sie auf die ordnungsgemäße Erfüllung Ihrer arbeitsvertraglichen Pflichten hinzuweisen.
                    </p>
                    <p>
                        Wir sind am {DATE_OF_NOTICE} darüber informiert worden, dass Sie sich entgegen der arbeitsvertraglichen Verpflichtungen verhalten haben.
                        Der Arbeitnehmer hat eine Vertragsstrafe §14.1 an den Arbeitgeber zu zahlen, wenn
                    </p>
                    
                    {REASON}
                    
                    <p>Tag des Verstoßes:</p>
                    
                    <br>
            
                    <p>am {DATE_OF_VIOLATION} - Vertragsstrafe beträgt: {AMOUNT} Euro</p>
            
            
                    <p>Hinweis: {NOTE}</p>
            
                    <p>
                        Für alle übrigen in § 14.1 genannten Fälle ist ein Bruttotagesentgelt für jeden Tag der Zuwiderhandlung verwirkt. Sie haben damit Ihre Pflichten aus dem Arbeitsvertrag verletzt. Wir erwarten, dass Sie dieses Verhalten  in dem oben geschilderten Umfang einstellen, weil Sie andernfalls gegen das Arbeitsvertrag verstoßen.
                        Wir fordern Sie deshalb ausdrücklich auf, das oben geschilderte Verhalten zukünftig zu unterlassen und Ihre Pflichten aus dem Arbeitsvertrag zu erfüllen.
                        Im Falle der Wiederholung des in dieser Abmahnung gerügten Verhaltens behalten wir uns vor, Ihr Arbeitsverhältnis ordentlich, gegebenenfalls auch außerordentlich fristlos zu kündigen.
                    </p>
            
                    <p>
                        Eine Durchschrift dieser Erinnerung legen wir in der Personalakte ab.
                    </p>
                '
            ],
            [
                'type'  => 'basic',
                'name'  => 'withdrawal_receipt',
                'title' => 'Kündigungsbestätigung',
                'text' => '
                    <p><strong>Betreff:</strong> Kündigungsbestätigung des Arbeitsverhältnisses</p>

                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME} ,</p>
            
                    <p>Hiermit bestätigen wir, dass wir Ihre Kündigung vom {DATE_OF_CREATION}  am {DATE_OF_RECEIPT} erhalten haben und dass Ihr Arbeitsverhältnis wie gewünscht zum {NOTICE_TO} enden wird.</p>
            
                    <p>Gemäß § 6.6 des Arbeitsvertrages sind Sie verpflichtet, etwaige Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene Bereicherung zurückzuzahlen. Bitte informieren Sie uns in diesem Falle, bis wann bzw. wie Sie den ausstehenden Betrag zurückzahlen werden. Sollten wir diesbezüglich nichts von Ihnen hören, werden wir weitere rechtliche Schritte gegen Sie einleiten.</p>
            
                    <p>Wir wünschen Ihnen für Ihren weiteren privaten und beruflichen Lebensweg alles Gute.</p>
            
                    <p>Mit freundlichen Grüßen</p>
            
                    <p>GF.: {SIGNATURE}</p>
                '
            ],
        ]);
    }
}
