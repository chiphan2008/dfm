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
 * ModelBusStation.h
 * 
 * 
 */

#ifndef ModelBusStation_H_
#define ModelBusStation_H_

#include <QJsonObject>


#include <QDateTime>
#include <QString>

#include "SWGObject.h"

namespace api {

class ModelBusStation: public SWGObject {
public:
    ModelBusStation();
    ModelBusStation(QString* json);
    virtual ~ModelBusStation();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelBusStation* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    QString* getName();
    void setName(QString* name);

    QString* getAddress();
    void setAddress(QString* address);

    double getLat();
    void setLat(double lat);

    double getLng();
    void setLng(double lng);

    QDateTime* getCreatedAt();
    void setCreatedAt(QDateTime* created_at);

    QDateTime* getUpdatedAt();
    void setUpdatedAt(QDateTime* updated_at);


private:
    qint64 id;
    QString* name;
    QString* address;
    double lat;
    double lng;
    QDateTime* created_at;
    QDateTime* updated_at;
};

}

#endif /* ModelBusStation_H_ */