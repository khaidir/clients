<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::insert([
            ['name' => 'Afghanistan', 'code' => 'AFG', 'capital' => 'Kabul', 'status' => true],
            ['name' => 'Albania', 'code' => 'ALB', 'capital' => 'Tirana', 'status' => true],
            ['name' => 'Algeria', 'code' => 'DZA', 'capital' => 'Algiers', 'status' => true],
            ['name' => 'Andorra', 'code' => 'AND', 'capital' => 'Andorra la Vella', 'status' => true],
            ['name' => 'Angola', 'code' => 'AGO', 'capital' => 'Luanda', 'status' => true],
            ['name' => 'Antigua and Barbuda', 'code' => 'ATG', 'capital' => 'Saint John\'s', 'status' => true],
            ['name' => 'Argentina', 'code' => 'ARG', 'capital' => 'Buenos Aires', 'status' => true],
            ['name' => 'Armenia', 'code' => 'ARM', 'capital' => 'Yerevan', 'status' => true],
            ['name' => 'Australia', 'code' => 'AUS', 'capital' => 'Canberra', 'status' => true],
            ['name' => 'Austria', 'code' => 'AUT', 'capital' => 'Vienna', 'status' => true],
            ['name' => 'Azerbaijan', 'code' => 'AZE', 'capital' => 'Baku', 'status' => true],
            ['name' => 'Bahamas', 'code' => 'BHS', 'capital' => 'Nassau', 'status' => true],
            ['name' => 'Bahrain', 'code' => 'BHR', 'capital' => 'Manama', 'status' => true],
            ['name' => 'Bangladesh', 'code' => 'BGD', 'capital' => 'Dhaka', 'status' => true],
            ['name' => 'Barbados', 'code' => 'BRB', 'capital' => 'Bridgetown', 'status' => true],
            ['name' => 'Belarus', 'code' => 'BLR', 'capital' => 'Minsk', 'status' => true],
            ['name' => 'Belgium', 'code' => 'BEL', 'capital' => 'Brussels', 'status' => true],
            ['name' => 'Belize', 'code' => 'BLZ', 'capital' => 'Belmopan', 'status' => true],
            ['name' => 'Benin', 'code' => 'BEN', 'capital' => 'Porto-Novo', 'status' => true],
            ['name' => 'Bhutan', 'code' => 'BTN', 'capital' => 'Thimphu', 'status' => true],
            ['name' => 'Bolivia', 'code' => 'BOL', 'capital' => 'Sucre', 'status' => true],
            ['name' => 'Bosnia and Herzegovina', 'code' => 'BIH', 'capital' => 'Sarajevo', 'status' => true],
            ['name' => 'Botswana', 'code' => 'BWA', 'capital' => 'Gaborone', 'status' => true],
            ['name' => 'Brazil', 'code' => 'BRA', 'capital' => 'Brasília', 'status' => true],
            ['name' => 'Brunei', 'code' => 'BRN', 'capital' => 'Bandar Seri Begawan', 'status' => true],
            ['name' => 'Bulgaria', 'code' => 'BGR', 'capital' => 'Sofia', 'status' => true],
            ['name' => 'Burkina Faso', 'code' => 'BFA', 'capital' => 'Ouagadougou', 'status' => true],
            ['name' => 'Burundi', 'code' => 'BDI', 'capital' => 'Gitega', 'status' => true],
            ['name' => 'Cabo Verde', 'code' => 'CPV', 'capital' => 'Praia', 'status' => true],
            ['name' => 'Cambodia', 'code' => 'KHM', 'capital' => 'Phnom Penh', 'status' => true],
            ['name' => 'Cameroon', 'code' => 'CMR', 'capital' => 'Yaoundé', 'status' => true],
            ['name' => 'Canada', 'code' => 'CAN', 'capital' => 'Ottawa', 'status' => true],
            ['name' => 'Central African Republic', 'code' => 'CAF', 'capital' => 'Bangui', 'status' => true],
            ['name' => 'Chad', 'code' => 'TCD', 'capital' => 'N\'Djamena', 'status' => true],
            ['name' => 'Chile', 'code' => 'CHL', 'capital' => 'Santiago', 'status' => true],
            ['name' => 'China', 'code' => 'CHN', 'capital' => 'Beijing', 'status' => true],
            ['name' => 'Colombia', 'code' => 'COL', 'capital' => 'Bogotá', 'status' => true],
            ['name' => 'Comoros', 'code' => 'COM', 'capital' => 'Moroni', 'status' => true],
            ['name' => 'Congo (Congo-Brazzaville)', 'code' => 'COG', 'capital' => 'Brazzaville', 'status' => true],
            ['name' => 'Costa Rica', 'code' => 'CRI', 'capital' => 'San José', 'status' => true],
            ['name' => 'Croatia', 'code' => 'HRV', 'capital' => 'Zagreb', 'status' => true],
            ['name' => 'Cuba', 'code' => 'CUB', 'capital' => 'Havana', 'status' => true],
            ['name' => 'Cyprus', 'code' => 'CYP', 'capital' => 'Nicosia', 'status' => true],
            ['name' => 'Czechia (Czech Republic)', 'code' => 'CZE', 'capital' => 'Prague', 'status' => true],
            ['name' => 'Democratic Republic of the Congo', 'code' => 'COD', 'capital' => 'Kinshasa', 'status' => true],
            ['name' => 'Denmark', 'code' => 'DNK', 'capital' => 'Copenhagen', 'status' => true],
            ['name' => 'Djibouti', 'code' => 'DJI', 'capital' => 'Djibouti', 'status' => true],
            ['name' => 'Dominica', 'code' => 'DMA', 'capital' => 'Roseau', 'status' => true],
            ['name' => 'Dominican Republic', 'code' => 'DOM', 'capital' => 'Santo Domingo', 'status' => true],
            ['name' => 'Ecuador', 'code' => 'ECU', 'capital' => 'Quito', 'status' => true],
            ['name' => 'Egypt', 'code' => 'EGY', 'capital' => 'Cairo', 'status' => true],
            ['name' => 'El Salvador', 'code' => 'SLV', 'capital' => 'San Salvador', 'status' => true],
            ['name' => 'Equatorial Guinea', 'code' => 'GNQ', 'capital' => 'Malabo', 'status' => true],
            ['name' => 'Eritrea', 'code' => 'ERI', 'capital' => 'Asmara', 'status' => true],
            ['name' => 'Estonia', 'code' => 'EST', 'capital' => 'Tallinn', 'status' => true],
            ['name' => 'Eswatini (fmr. "Swaziland")', 'code' => 'SWZ', 'capital' => 'Mbabane', 'status' => true],
            ['name' => 'Ethiopia', 'code' => 'ETH', 'capital' => 'Addis Ababa', 'status' => true],
            ['name' => 'Fiji', 'code' => 'FJI', 'capital' => 'Suva', 'status' => true],
            ['name' => 'Finland', 'code' => 'FIN', 'capital' => 'Helsinki', 'status' => true],
            ['name' => 'France', 'code' => 'FRA', 'capital' => 'Paris', 'status' => true],
            ['name' => 'Gabon', 'code' => 'GAB', 'capital' => 'Libreville', 'status' => true],
            ['name' => 'Gambia', 'code' => 'GMB', 'capital' => 'Banjul', 'status' => true],
            ['name' => 'Georgia', 'code' => 'GEO', 'capital' => 'Tbilisi', 'status' => true],
            ['name' => 'Germany', 'code' => 'DEU', 'capital' => 'Berlin', 'status' => true],
            ['name' => 'Ghana', 'code' => 'GHA', 'capital' => 'Accra', 'status' => true],
            ['name' => 'Greece', 'code' => 'GRC', 'capital' => 'Athens', 'status' => true],
            ['name' => 'Grenada', 'code' => 'GRD', 'capital' => 'Saint George\'s', 'status' => true],
            ['name' => 'Guatemala', 'code' => 'GTM', 'capital' => 'Guatemala City', 'status' => true],
            ['name' => 'Guinea', 'code' => 'GIN', 'capital' => 'Conakry', 'status' => true],
            ['name' => 'Guinea-Bissau', 'code' => 'GNB', 'capital' => 'Bissau', 'status' => true],
            ['name' => 'Guyana', 'code' => 'GUY', 'capital' => 'Georgetown', 'status' => true],
            ['name' => 'Haiti', 'code' => 'HTI', 'capital' => 'Port-au-Prince', 'status' => true],
            ['name' => 'Honduras', 'code' => 'HND', 'capital' => 'Tegucigalpa', 'status' => true],
            ['name' => 'Hungary', 'code' => 'HUN', 'capital' => 'Budapest', 'status' => true],
            ['name' => 'Iceland', 'code' => 'ISL', 'capital' => 'Reykjavik', 'status' => true],
            ['name' => 'India', 'code' => 'IND', 'capital' => 'New Delhi', 'status' => true],
            ['name' => 'Indonesia', 'code' => 'IDN', 'capital' => 'Jakarta', 'status' => true],
            ['name' => 'Iran', 'code' => 'IRN', 'capital' => 'Tehran', 'status' => true],
            ['name' => 'Iraq', 'code' => 'IRQ', 'capital' => 'Baghdad', 'status' => true],
            ['name' => 'Ireland', 'code' => 'IRL', 'capital' => 'Dublin', 'status' => true],
            ['name' => 'Israel', 'code' => 'ISR', 'capital' => 'Jerusalem', 'status' => true],
            ['name' => 'Italy', 'code' => 'ITA', 'capital' => 'Rome', 'status' => true],
            ['name' => 'Jamaica', 'code' => 'JAM', 'capital' => 'Kingston', 'status' => true],
            ['name' => 'Japan', 'code' => 'JPN', 'capital' => 'Tokyo', 'status' => true],
            ['name' => 'Jordan', 'code' => 'JOR', 'capital' => 'Amman', 'status' => true],
            ['name' => 'Kazakhstan', 'code' => 'KAZ', 'capital' => 'Astana', 'status' => true],
            ['name' => 'Kenya', 'code' => 'KEN', 'capital' => 'Nairobi', 'status' => true],
            ['name' => 'Kiribati', 'code' => 'KIR', 'capital' => 'Tarawa', 'status' => true],
            ['name' => 'Kuwait', 'code' => 'KWT', 'capital' => 'Kuwait City', 'status' => true],
            ['name' => 'Kyrgyzstan', 'code' => 'KGZ', 'capital' => 'Bishkek', 'status' => true],
            ['name' => 'Laos', 'code' => 'LAO', 'capital' => 'Vientiane', 'status' => true],
            ['name' => 'Latvia', 'code' => 'LVA', 'capital' => 'Riga', 'status' => true],
            ['name' => 'Lebanon', 'code' => 'LBN', 'capital' => 'Beirut', 'status' => true],
            ['name' => 'Lesotho', 'code' => 'LSO', 'capital' => 'Maseru', 'status' => true],
            ['name' => 'Liberia', 'code' => 'LBR', 'capital' => 'Monrovia', 'status' => true],
            ['name' => 'Libya', 'code' => 'LBY', 'capital' => 'Tripoli', 'status' => true],
            ['name' => 'Liechtenstein', 'code' => 'LIE', 'capital' => 'Vaduz', 'status' => true],
            ['name' => 'Lithuania', 'code' => 'LTU', 'capital' => 'Vilnius', 'status' => true],
            ['name' => 'Luxembourg', 'code' => 'LUX', 'capital' => 'Luxembourg City', 'status' => true],
            ['name' => 'Madagascar', 'code' => 'MDG', 'capital' => 'Antananarivo', 'status' => true],
            ['name' => 'Malawi', 'code' => 'MWI', 'capital' => 'Lilongwe', 'status' => true],
            ['name' => 'Malaysia', 'code' => 'MYS', 'capital' => 'Kuala Lumpur', 'status' => true],
            ['name' => 'Maldives', 'code' => 'MDV', 'capital' => 'Malé', 'status' => true],
            ['name' => 'Mali', 'code' => 'MLI', 'capital' => 'Bamako', 'status' => true],
            ['name' => 'Malta', 'code' => 'MLT', 'capital' => 'Valletta', 'status' => true],
            ['name' => 'Marshall Islands', 'code' => 'MHL', 'capital' => 'Majuro', 'status' => true],
            ['name' => 'Mauritania', 'code' => 'MRT', 'capital' => 'Nouakchott', 'status' => true],
            ['name' => 'Mauritius', 'code' => 'MUS', 'capital' => 'Port Louis', 'status' => true],
            ['name' => 'Mexico', 'code' => 'MEX', 'capital' => 'Mexico City', 'status' => true],
            ['name' => 'Micronesia', 'code' => 'FSM', 'capital' => 'Palikir', 'status' => true],
            ['name' => 'Moldova', 'code' => 'MDA', 'capital' => 'Chișinău', 'status' => true],
            ['name' => 'Monaco', 'code' => 'MCO', 'capital' => 'Monaco', 'status' => true],
            ['name' => 'Mongolia', 'code' => 'MNG', 'capital' => 'Ulaanbaatar', 'status' => true],
            ['name' => 'Montenegro', 'code' => 'MNE', 'capital' => 'Podgorica', 'status' => true],
            ['name' => 'Morocco', 'code' => 'MAR', 'capital' => 'Rabat', 'status' => true],
            ['name' => 'Mozambique', 'code' => 'MOZ', 'capital' => 'Maputo', 'status' => true],
            ['name' => 'Myanmar (formerly Burma)', 'code' => 'MMR', 'capital' => 'Naypyidaw', 'status' => true],
            ['name' => 'Namibia', 'code' => 'NAM', 'capital' => 'Windhoek', 'status' => true],
            ['name' => 'Nauru', 'code' => 'NRU', 'capital' => 'Yaren District', 'status' => true],
            ['name' => 'Nepal', 'code' => 'NPL', 'capital' => 'Kathmandu', 'status' => true],
            ['name' => 'Netherlands', 'code' => 'NLD', 'capital' => 'Amsterdam', 'status' => true],
            ['name' => 'New Zealand', 'code' => 'NZL', 'capital' => 'Wellington', 'status' => true],
            ['name' => 'Nicaragua', 'code' => 'NIC', 'capital' => 'Managua', 'status' => true],
            ['name' => 'Niger', 'code' => 'NER', 'capital' => 'Niamey', 'status' => true],
            ['name' => 'Nigeria', 'code' => 'NGA', 'capital' => 'Abuja', 'status' => true],
            ['name' => 'North Korea', 'code' => 'PRK', 'capital' => 'Pyongyang', 'status' => true],
            ['name' => 'North Macedonia', 'code' => 'MKD', 'capital' => 'Skopje', 'status' => true],
            ['name' => 'Norway', 'code' => 'NOR', 'capital' => 'Oslo', 'status' => true],
            ['name' => 'Oman', 'code' => 'OMN', 'capital' => 'Muscat', 'status' => true],
            ['name' => 'Pakistan', 'code' => 'PAK', 'capital' => 'Islamabad', 'status' => true],
            ['name' => 'Palau', 'code' => 'PLW', 'capital' => 'Ngerulmud', 'status' => true],
            ['name' => 'Panama', 'code' => 'PAN', 'capital' => 'Panama City', 'status' => true],
            ['name' => 'Papua New Guinea', 'code' => 'PNG', 'capital' => 'Port Moresby', 'status' => true],
            ['name' => 'Paraguay', 'code' => 'PRY', 'capital' => 'Asunción', 'status' => true],
            ['name' => 'Peru', 'code' => 'PER', 'capital' => 'Lima', 'status' => true],
            ['name' => 'Philippines', 'code' => 'PHL', 'capital' => 'Manila', 'status' => true],
            ['name' => 'Poland', 'code' => 'POL', 'capital' => 'Warsaw', 'status' => true],
            ['name' => 'Portugal', 'code' => 'PRT', 'capital' => 'Lisbon', 'status' => true],
            ['name' => 'Qatar', 'code' => 'QAT', 'capital' => 'Doha', 'status' => true],
            ['name' => 'Romania', 'code' => 'ROU', 'capital' => 'Bucharest', 'status' => true],
            ['name' => 'Russia', 'code' => 'RUS', 'capital' => 'Moscow', 'status' => true],
            ['name' => 'Rwanda', 'code' => 'RWA', 'capital' => 'Kigali', 'status' => true],
            ['name' => 'Saint Kitts and Nevis', 'code' => 'KNA', 'capital' => 'Basseterre', 'status' => true],
            ['name' => 'Saint Lucia', 'code' => 'LCA', 'capital' => 'Castries', 'status' => true],
            ['name' => 'Saint Vincent and the Grenadines', 'code' => 'VCT', 'capital' => 'Kingstown', 'status' => true],
            ['name' => 'Samoa', 'code' => 'WSM', 'capital' => 'Apia', 'status' => true],
            ['name' => 'San Marino', 'code' => 'SMR', 'capital' => 'San Marino', 'status' => true],
            ['name' => 'Sao Tome and Principe', 'code' => 'STP', 'capital' => 'São Tomé', 'status' => true],
            ['name' => 'Saudi Arabia', 'code' => 'SAU', 'capital' => 'Riyadh', 'status' => true],
            ['name' => 'Senegal', 'code' => 'SEN', 'capital' => 'Dakar', 'status' => true],
            ['name' => 'Serbia', 'code' => 'SRB', 'capital' => 'Belgrade', 'status' => true],
            ['name' => 'Seychelles', 'code' => 'SYC', 'capital' => 'Victoria', 'status' => true],
            ['name' => 'Sierra Leone', 'code' => 'SLE', 'capital' => 'Freetown', 'status' => true],
            ['name' => 'Singapore', 'code' => 'SGP', 'capital' => 'Singapore', 'status' => true],
            ['name' => 'Slovakia', 'code' => 'SVK', 'capital' => 'Bratislava', 'status' => true],
            ['name' => 'Slovenia', 'code' => 'SVN', 'capital' => 'Ljubljana', 'status' => true],
            ['name' => 'Solomon Islands', 'code' => 'SLB', 'capital' => 'Honiara', 'status' => true],
            ['name' => 'Somalia', 'code' => 'SOM', 'capital' => 'Mogadishu', 'status' => true],
            ['name' => 'South Africa', 'code' => 'ZAF', 'capital' => 'Pretoria', 'status' => true],
            ['name' => 'South Korea', 'code' => 'KOR', 'capital' => 'Seoul', 'status' => true],
            ['name' => 'South Sudan', 'code' => 'SSD', 'capital' => 'Juba', 'status' => true],
            ['name' => 'Spain', 'code' => 'ESP', 'capital' => 'Madrid', 'status' => true],
            ['name' => 'Sri Lanka', 'code' => 'LKA', 'capital' => 'Sri Jayawardenepura Kotte', 'status' => true],
            ['name' => 'Sudan', 'code' => 'SDN', 'capital' => 'Khartoum', 'status' => true],
            ['name' => 'Suriname', 'code' => 'SUR', 'capital' => 'Paramaribo', 'status' => true],
            ['name' => 'Sweden', 'code' => 'SWE', 'capital' => 'Stockholm', 'status' => true],
            ['name' => 'Switzerland', 'code' => 'CHE', 'capital' => 'Bern', 'status' => true],
            ['name' => 'Syria', 'code' => 'SYR', 'capital' => 'Damascus', 'status' => true],
            ['name' => 'Taiwan', 'code' => 'TWN', 'capital' => 'Taipei', 'status' => true],
            ['name' => 'Tajikistan', 'code' => 'TJK', 'capital' => 'Dushanbe', 'status' => true],
            ['name' => 'Tanzania', 'code' => 'TZA', 'capital' => 'Dodoma', 'status' => true],
            ['name' => 'Thailand', 'code' => 'THA', 'capital' => 'Bangkok', 'status' => true],
            ['name' => 'Togo', 'code' => 'TGO', 'capital' => 'Lomé', 'status' => true],
            ['name' => 'Tonga', 'code' => 'TON', 'capital' => 'Nukuʻalofa', 'status' => true],
            ['name' => 'Trinidad and Tobago', 'code' => 'TTO', 'capital' => 'Port of Spain', 'status' => true],
            ['name' => 'Tunisia', 'code' => 'TUN', 'capital' => 'Tunis', 'status' => true],
            ['name' => 'Turkey', 'code' => 'TUR', 'capital' => 'Ankara', 'status' => true],
            ['name' => 'Turkmenistan', 'code' => 'TKM', 'capital' => 'Ashgabat', 'status' => true],
            ['name' => 'Tuvalu', 'code' => 'TUV', 'capital' => 'Funafuti', 'status' => true],
            ['name' => 'Uganda', 'code' => 'UGA', 'capital' => 'Kampala', 'status' => true],
            ['name' => 'Ukraine', 'code' => 'UKR', 'capital' => 'Kyiv', 'status' => true],
            ['name' => 'United Arab Emirates', 'code' => 'ARE', 'capital' => 'Abu Dhabi', 'status' => true],
            ['name' => 'United Kingdom', 'code' => 'GBR', 'capital' => 'London', 'status' => true],
            ['name' => 'United States', 'code' => 'USA', 'capital' => 'Washington, D.C.', 'status' => true],
            ['name' => 'Uruguay', 'code' => 'URY', 'capital' => 'Montevideo', 'status' => true],
            ['name' => 'Uzbekistan', 'code' => 'UZB', 'capital' => 'Tashkent', 'status' => true],
            ['name' => 'Vanuatu', 'code' => 'VUT', 'capital' => 'Port Vila', 'status' => true],
            ['name' => 'Vatican City', 'code' => 'VAT', 'capital' => 'Vatican City', 'status' => true],
            ['name' => 'Venezuela', 'code' => 'VEN', 'capital' => 'Caracas', 'status' => true],
            ['name' => 'Vietnam', 'code' => 'VNM', 'capital' => 'Hanoi', 'status' => true],
            ['name' => 'Yemen', 'code' => 'YEM', 'capital' => 'Sana\'a', 'status' => true],
            ['name' => 'Zambia', 'code' => 'ZMB', 'capital' => 'Lusaka', 'status' => true],
            ['name' => 'Zimbabwe', 'code' => 'ZWE', 'capital' => 'Harare', 'status' => true],
        ]);
    }
}