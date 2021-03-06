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
 * ModelDevModelForm.h
 * 
 * 
 */

#ifndef ModelDevModelForm_H_
#define ModelDevModelForm_H_

#include <QJsonObject>


#include <QList>
#include <QString>

#include "SWGObject.h"

namespace api {

class ModelDevModelForm: public SWGObject {
public:
    ModelDevModelForm();
    ModelDevModelForm(QString* json);
    virtual ~ModelDevModelForm();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelDevModelForm* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    QString* getName();
    void setName(QString* name);

    QString* getModel();
    void setModel(QString* model);

    QList<QString*>* getFeatures();
    void setFeatures(QList<QString*>* features);


private:
    qint64 id;
    QString* name;
    QString* model;
    QList<QString*>* features;
};

}

#endif /* ModelDevModelForm_H_ */
