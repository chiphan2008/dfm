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
 * ModelCollected.h
 * 
 * 
 */

#ifndef ModelCollected_H_
#define ModelCollected_H_

#include <QJsonObject>


#include <QList>

#include "SWGObject.h"

namespace api {

class ModelCollected: public SWGObject {
public:
    ModelCollected();
    ModelCollected(QString* json);
    virtual ~ModelCollected();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelCollected* fromJson(QString &jsonString);

    QList<qint32>* getShifts();
    void setShifts(QList<qint32>* shifts);


private:
    QList<qint32>* shifts;
};

}

#endif /* ModelCollected_H_ */