# Platform Engineering Test

Depending on the position you are applying for, there are two options for this test: 

1. PHP only
2. PHP and AWS

## General Instructions

1. Fork this repo.
2. Make the changes needed to accomplish what is listed below.
3. Deploy this somewhere and send us a link to the deployed app and the repo, then we can schedule some time to meet!

### PHP Requirements

In this exercise, we're asking you to: **Create a filter for productions based on start date and end date.**

**Requirements:**

1) Create an endpoint that:

- Fetches data from the [ABQ Film Office public dataset](https://coagisweb.cabq.gov/arcgis/rest/services/public/FilmLocations/MapServer/0/query?where=1%3D1&text=&objectIds=&time=&geometry=&geometryType=esriGeometryEnvelope&inSR=&spatialRel=esriSpatialRelIntersects&relationParam=&outFields=*&returnGeometry=true&maxAllowableOffset=&geometryPrecision=&outSR=4326&returnIdsOnly=false&returnCountOnly=false&orderByFields=&groupByFieldsForStatistics=&outStatistics=&returnZ=false&returnM=false&gdbVersion=&f=pjson). This data is a collection of locations where Films/TV/etc have been shot. Documentation found [here](http://data.cabq.gov/business/filmlocations/MetaData.pdf). 
- Filters data on shoot start date and end date -- please use PHP to do this and not the api endpoint
- Adjusts for your timezone
- Filters out duplicate productions
- Returns JSON data

```
{
    count: 1,
    productions: [
        {
            title: "production name",
            type: "movie, tv or other",
            sites: [
                {
                    name: "site name",
                    shoot_date: "Month Date, Year"
                }
            ]
        }
    ]
}
```

2) Create a simple front end that: 

- Displays all data to user -- just a bulleted list is fine
- Display date in a human readable format in your timezone

There is a start at `routes/web.php` and `resources/views/show.blade.php`.

That's it! 


# AWS Test
If you are applying for a role that includes some operations responsibilities, deploy the PHP app that you created above on AWS. We'll create an account for you and send over the credentials. With that AWS account: 

1. Create a key pair
2. Launch an EC2 instance in eu-central-1 region
3. Login to that instance via ssh
4. Clone your app's git repo
5. Run the PHP app and serve requests
6. Securely send us the .pem file
