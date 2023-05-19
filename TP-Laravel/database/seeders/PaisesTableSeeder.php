<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pais;

class PaisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //array de paises
        $paises = [
            [1, 'Australia', 'AU'],
            [2, 'Austria', 'AT'],
            [3, 'Azerbaiyán', 'AZ'],
            [4, 'Anguilla', 'AI'],
            [5, 'Argentina', 'AR'],
            [6, 'Armenia', 'AM'],
            [7, 'Bielorrusia', 'BY'],
            [8, 'Belice', 'BZ'],
            [9, 'Bélgica', 'BE'],
            [10, 'Bermudas', 'BM'],
            [11, 'Bulgaria', 'BG'],
            [12, 'Brasil', 'BR'],
            [13, 'Reino Unido', 'UK'],
            [14, 'Hungría', 'HU'],
            [15, 'Vietnam', 'VN'],
            [16, 'Haiti', 'HT'],
            [17, 'Guadalupe', 'GP'],
            [18, 'Alemania', 'DE'],
            [19, 'Países Bajos, Holanda', 'NL'],
            [20, 'Grecia', 'GR'],
            [21, 'Georgia', 'GE'],
            [22, 'Dinamarca', 'DK'],
            [23, 'Egipto', 'EG'],
            [24, 'Israel', 'IL'],
            [25, 'India', 'IN'],
            [26, 'Irán', 'IR'],
            [27, 'Irlanda', 'IE'],
            [28, 'España', 'ES'],
            [29, 'Italia', 'IT'],
            [30, 'Kazajstán', 'KZ'],
            [31, 'Camerún', 'CM'],
            [32, 'Canadá', 'CA'],
            [33, 'Chipre', 'CY'],
            [34, 'Kirguistán', 'KG'],
            [35, 'China', 'CN'],
            [36, 'Costa Rica', 'CR'],
            [37, 'Kuwait', 'KW'],
            [38, 'Letonia', 'LV'],
            [39, 'Libia', 'LY'],
            [40, 'Lituania', 'LT'],
            [41, 'Luxemburgo', 'LU'],
            [42, 'México', 'MX'],
            [43, 'Moldavia', 'MD'],
            [44, 'Mónaco', 'MC'],
            [45, 'Nueva Zelanda', 'NZ'],
            [46, 'Noruega', 'NO'],
            [47, 'Polonia', 'PL'],
            [48, 'Portugal', 'PT'],
            [49, 'Reunión', 'RE'],
            [50, 'Rusia', 'RU'],
            [51, 'El Salvador', 'SV'],
            [52, 'Eslovaquia', 'SK'],
            [53, 'Eslovenia', 'SI'],
            [54, 'Surinam', 'SR'],
            [55, 'Estados Unidos', 'US'],
            [56, 'Tadjikistán', 'TJ'],
            [57, 'Turkmenistán', 'TM'],
            [58, 'Islas Turcas y Caicos', 'TC'],
            [59, 'Turquía', 'TR'],
            [60, 'Uganda', 'UG'],
            [61, 'Uzbekistán', 'UZ'],
            [62, 'Ucrania', 'UA'],
            [63, 'Finlandia', 'FI'],
            [64, 'Francia', 'FR'],
            [65, 'República Checa', 'CZ'],
            [66, 'Suiza', 'CH'],
            [67, 'Suecia', 'SE'],
            [68, 'Estonia', 'EE'],
            [69, 'Corea del Sur', 'KR'],
            [70, 'Japón', 'JP'],
            [71, 'Croacia', 'HR'],
            [72, 'Rumanía', 'RO'],
            [73, 'Hong Kong', 'HK'],
            [74, 'Indonesia', 'ID'],
            [75, 'Jordania', 'JO'],
            [76, 'Malasia', 'MY'],
            [77, 'Singapur', 'SG'],
            [78, 'Taiwán', 'TW'],
            [79, 'Bosnia y Herzegovina', 'BA'],
            [80, 'Bahamas', 'BS'],
            [81, 'Chile', 'CL'],
            [82, 'Colombia', 'CO'],
            [83, 'Islandia', 'IS'],
            [84, 'Corea del Norte', 'KP'],
            [85, 'Macedonia', 'MK'],
            [86, 'Malta', 'MT'],
            [87, 'Pakistán', 'PK'],
            [88, 'Papúa-Nueva Guinea', 'PG'],
            [89, 'Perú', 'PE'],
            [90, 'Filipinas', 'PH'],
            [91, 'Arabia Saudita', 'SA'],
            [92, 'Tailandia', 'TH'],
            [93, 'Emiratos Árabes Unidos', 'AE'],
            [94, 'Groenlandia', 'GL'],
            [95, 'Venezuela', 'VE'],
            [96, 'Zimbabwe', 'ZW'],
            [97, 'Kenia', 'KE'],
            [98, 'Argelia', 'DZ'],
            [99, 'Líbano', 'LB'],
            [100, 'Botsuana', 'BW'],
            [101, 'Tanzania', 'TZ'],
            [102, 'Namibia', 'NA'],
            [103, 'Ecuador', 'EC'],
            [104, 'Marruecos', 'MA'],
            [105, 'Ghana', 'GH'],
            [106, 'Siria', 'SY'],
            [107, 'Nepal', 'NP'],
            [108, 'Mauritania', 'MR'],
            [109, 'Seychelles', 'SC'],
            [110, 'Paraguay', 'PY'],
            [111, 'Uruguay', 'UY'],
            [112, 'Congo (Brazzaville)', 'CG'],
            [113, 'Cuba', 'CU'],
            [114, 'Albania', 'AL'],
            [115, 'Nigeria', 'NG'],
            [116, 'Zambia', 'ZM'],
            [117, 'Mozambique', 'MZ'],
            [119, 'Angola', 'AO'],
            [120, 'Sri Lanka', 'LK'],
            [121, 'Etiopía', 'ET'],
            [122, 'Túnez', 'TN'],
            [123, 'Bolivia', 'BO'],
            [124, 'Panamá', 'PA'],
            [125, 'Malawi', 'MW'],
            [126, 'Liechtenstein', 'LI'],
            [127, 'Bahrein', 'BH'],
            [128, 'Barbados', 'BB'],
            [130, 'Chad', 'TD'],
            [131, 'Man, Isla de', 'IM'],
            [132, 'Jamaica', 'JM'],
            [133, 'Malí', 'ML'],
            [134, 'Madagascar', 'MG'],
            [135, 'Senegal', 'SN'],
            [136, 'Togo', 'TG'],
            [137, 'Honduras', 'HN'],
            [138, 'República Dominicana', 'DO'],
            [139, 'Mongolia', 'MN'],
            [140, 'Irak', 'IQ'],
            [141, 'Sudáfrica', 'ZA'],
            [142, 'Aruba', 'AW'],
            [143, 'Gibraltar', 'GI'],
            [144, 'Afganistán', 'AF'],
            [145, 'Andorra', 'AD'],
            [147, 'Antigua y Barbuda', 'AG'],
            [149, 'Bangladesh', 'BD'],
            [151, 'Benín', 'BJ'],
            [152, 'Bután', 'BT'],
            [154, 'Islas Vírgenes Británicas', 'VG'],
            [155, 'Brunéi', 'BN'],
            [156, 'Burkina Faso', 'BF'],
            [157, 'Burundi', 'BI'],
            [158, 'Camboya', 'KH'],
            [159, 'Cabo Verde', 'CV'],
            [164, 'Comores', 'KM'],
            [165, 'Congo (Kinshasa)', 'CD'],
            [166, 'Cook, Islas', 'CK'],
            [168, 'Costa de Marfil', 'CI'],
            [169, 'Djibouti, Yibuti', 'DJ'],
            [171, 'Timor Oriental', 'TL'],
            [172, 'Guinea Ecuatorial', 'GQ'],
            [173, 'Eritrea', 'ER'],
            [175, 'Feroe, Islas', 'FO'],
            [176, 'Fiyi', 'FJ'],
            [178, 'Polinesia Francesa', 'PF'],
            [180, 'Gabón', 'GA'],
            [181, 'Gambia', 'GM'],
            [184, 'Granada', 'GD'],
            [185, 'Guatemala', 'GT'],
            [186, 'Guernsey', 'GG'],
            [187, 'Guinea', 'GN'],
            [188, 'Guinea-Bissau', 'GW'],
            [189, 'Guyana', 'GY'],
            [193, 'Jersey', 'JE'],
            [195, 'Kiribati', 'KI'],
            [196, 'Laos', 'LA'],
            [197, 'Lesotho', 'LS'],
            [198, 'Liberia', 'LR'],
            [200, 'Maldivas', 'MV'],
            [201, 'Martinica', 'MQ'],
            [202, 'Mauricio', 'MU'],
            [205, 'Myanmar', 'MM'],
            [206, 'Nauru', 'NR'],
            [207, 'Antillas Holandesas', 'AN'],
            [208, 'Nueva Caledonia', 'NC'],
            [209, 'Nicaragua', 'NI'],
            [210, 'Níger', 'NE'],
            [212, 'Norfolk Island', 'NF'],
            [213, 'Omán', 'OM'],
            [215, 'Isla Pitcairn', 'PN'],
            [216, 'Qatar', 'QA'],
            [217, 'Ruanda', 'RW'],
            [218, 'Santa Elena', 'SH'],
            [219, 'San Cristóbal y Nieves', 'KN'],
            [220, 'Santa Lucía', 'LC'],
            [221, 'San Pedro y Miquelón', 'PM'],
            [222, 'San Vicente y las Granadinas', 'VC'],
            [223, 'Samoa', 'WS'],
            [224, 'San Marino', 'SM'],
            [225, 'Santo Tomé y Príncipe', 'ST'],
            [226, 'Serbia y Montenegro', 'CS'],
            [227, 'Sierra Leona', 'SL'],
            [228, 'Islas Salomón', 'SB'],
            [229, 'Somalia', 'SO'],
            [232, 'Sudán', 'SD'],
            [234, 'Suazilandia', 'SZ'],
            [235, 'Tokelau', 'TK'],
            [236, 'Tonga', 'TO'],
            [237, 'Trinidad y Tobago', 'TT'],
            [239, 'Tuvalu', 'TV'],
            [240, 'Vanuatu', 'VU'],
            [241, 'Wallis y Futuna', 'WF'],
            [242, 'Sáhara Occidental', 'EH'],
            [243, 'Yemen', 'YE'],
            [246, 'Puerto Rico', 'PR'],
        ];

        //por cada elemento del pais, va a crear el objeto Pais
        foreach ($paises as $pais) {
            Pais::create([
                'idPais' => $pais[0],
                'nombrePais' => $pais[1],
                'nomenclatura' => $pais[2]
            ]);
        }
    
    }
}
