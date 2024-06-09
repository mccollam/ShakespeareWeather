# ShakespeareWeather
Current weather reports based on Shakespeare quotes

## Dev notes for myself
'country' and 'localtime' are both provided by the weatherapi.com location object

## Configuration
1. Copy `env.example` to `.env`
   `cp env.example .env`
2. Set the database and API credentials in `.env`
3. Create the database and give the DB user access to it
4. Run the setup scripts:
   `cd database && php create_tables.php && php populate_tables.php`

## Bugs
 * The table structure is not ideal.  Quotes should be in their own table and referenced by conditions, not repeated multiple times in the `weatherquotes` table
 * The setup is extremely hacky