/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */

/*
 * ModelGPSRecord.h
 * 
 * 
 */

#ifndef ModelGPSRecord_H_
#define ModelGPSRecord_H_

#include <QJsonObject>



#include "SWGObject.h"

namespace api {

class ModelGPSRecord: public SWGObject {
public:
    ModelGPSRecord();
    ModelGPSRecord(QString* json);
    virtual ~ModelGPSRecord();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelGPSRecord* fromJson(QString &jsonString);

    qint64 getTimestamp();
    void setTimestamp(qint64 timestamp);

    double getLat();
    void setLat(double lat);

    double getLng();
    void setLng(double lng);


private:
    qint64 timestamp;
    double lat;
    double lng;
};

}

#endif /* ModelGPSRecord_H_ */
