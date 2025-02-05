# StreetGroup Technical Test

An application to parse csv data.

## Requirements

- PHP :- 8.2 or above
- Composer :- To install the dependencies

## Install

Clone the repo to your working directory using your favorite CLI console (eg: GitBash, PowerShell, cmd or any of your choice) 

```bash
$ git clone https://github.com/sundew28/streetgroup.git
```
Once you are done cloning the repo next would be to run composer in your console to install laravel framework dependencies by running the below composer command. Make sure you have composer installed

Via Composer

```bash
$ composer install
```

## Workflow 

The purpose of the application is to extract data from a CSV file and display the results. I have made this application simple based on the sample csv file provided. Please note this solution needs to be refactored, for now to meet the task goals it is tailored to output the results. Run the below command in your console to view the results.

```bash
$ php artisan parse:csv
```

The application is designed not just to parse csv files but to handle / add drivers to parse data as per requirement. I have implement the manager design pattern to handle this if required. 
